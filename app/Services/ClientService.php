<?php

namespace App\Services;

use App\Enums\ClientStatus;
use App\Http\Resources\Clients\ClientResource;
use App\Models\Client;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Arr;

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
        $client->updateOrFail($validatedData);

        return new ClientResource(['client' => $client]);
    }


}
