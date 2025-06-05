<?php

namespace App\Services;

use App\DTO\V1\Auth\LoginDTO;
use App\Models\User;
use App\Repo\UserRepo;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AuthService
{
    private UserRepo $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepo();
    }

    /**
     * @param LoginDTO $loginDTO
     * @return User
     */
    public function login(LoginDTO $loginDTO): User
    {
        $user = $this->userRepo->findByEmail($loginDTO->email);
        if (! $user || ! Hash::check($loginDTO->password, $user->password)) {
            throw new RuntimeException('Wrong credentials',401);
        }

        return $user;
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
