<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;

class ClientController extends Controller
{

    public function __construct(
        private readonly ClientService $clientService
    ) {}

    public function store(StoreClientRequest $request)
    {
        return $this->clientService->store($request);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        return $this->clientService->update($client, $request);
    }


}
