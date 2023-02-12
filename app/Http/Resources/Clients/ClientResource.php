<?php

namespace App\Http\Resources\Clients;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $client = $this->resource;
        $data = [];
        if ($client["client"] instanceof Client) {
            $client_data = $client["client"];
            $data = [
                'first_name' => $client_data->first_name,
                'last_name' => $client_data->last_name,
                'address' => $client_data->address,
                'email' => $client_data->email,
                'phone' => $client_data->phone,
                'image' => $client_data->image,
            ];
        }
        if (!empty($data)) {
            return array_merge($data, [
                'token' => $client["token"],
            ]);
        }
        return [];
    }
}
