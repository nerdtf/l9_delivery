<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
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

    public function update(UpdateClientRequest $request)
    {
        return $this->clientService->update(auth()->user(), $request);
    }

    public function show()
    {
        return $this->clientService->show(auth()->id());
    }


}
