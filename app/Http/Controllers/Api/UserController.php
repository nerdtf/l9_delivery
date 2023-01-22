<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function store(StoreRequest $request)
    {
        return new UserResource(
            $this->userService->store($request->validated())
        );
    }

    public function show (int $id)
    {
        return User::findOrFail($id);
    }
}
