<?php

namespace App\Http\Controllers\Api\Authentications\Repository;

use App\Http\Controllers\Api\Authentications\Interface\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'email_verified_at' => now(),
        ]);
    }

    public function login(array $credentials): ?User
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }
        return null;
    }

    public function getUser(): ?User
    {
        return Auth::user();
    }

    public function logout(): bool
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return true;
        }
        return false;
    }
}
