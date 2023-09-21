<?php

namespace App\Services;

use App\Enums\ClientStatus;
use App\Http\Resources\Clients\ClientResource;
use App\Models\Client;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ClientService {

    public function store($validatedData): ClientResource
    {
        $validatedData = $validatedData->validated();
        $client = new Client();
        $client->password = bcrypt($validatedData['password'] ?? now()->timestamp);
        $client->fill(Arr::except($validatedData, ['password']));
        $client->status = ClientStatus::Active;
        $client->save();
        $token = JWTAuth::fromUser($client);
        //Log::debug($token);
        return new ClientResource([
            'token' => $token,
            'client' => $client
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(Client $client, $validatedData): ClientResource
    {
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        if (isset($validatedData['image'])) {
            $imageService = new ImageService();

            $oldImage = $client->image;
            if ($oldImage) {
                $imageService->deleteImage($oldImage);
            }

            $filename = $imageService->storeImage($validatedData['image']);
            $client->image = $filename;
            $client->save();
        }
        else{
            $client->updateOrFail($validatedData->toArray());
        }

        return new ClientResource(['client' => $client]);
    }

    public function show($userId): ClientResource
    {
        return new ClientResource(['client' => Client::find($userId)]);
    }


}
