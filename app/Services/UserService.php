<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function store(array $validated)
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser($validated);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(Auth::id() . ' | ' . $e->getMessage());
            throw new \RuntimeException($e->getMessage());
        }

        /** @var $user User|null */
        return User::findOrFail($user->id);
    }

    private function createUser(array $attributes): User
    {
        return User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);
    }
}


