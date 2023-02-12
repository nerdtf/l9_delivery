<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\LoginClientRequest;
use App\Http\Resources\Clients\ClientResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginClientRequest $request)
    {
        if (!$token = auth('client')->attempt($request->validated())) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return new ClientResource([
            'token' => $token,
            'client' => auth('client')->user()
        ]);
    }
}
