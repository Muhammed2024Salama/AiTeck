<?php

namespace App\Http\Controllers\Api\Authentications\Interface;

use App\Models\User;

interface AuthInterface
{
    public function register(array $data): User;
    public function login(array $credentials): ?User;
    public function getUser(): ?User;
    public function logout(): bool;
}
