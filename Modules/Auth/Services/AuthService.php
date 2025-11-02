<?php

namespace Modules\Auth\Services;

use Modules\Auth\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register a new user
     */
    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {
            // Create user
            $user = $this->userRepository->create($data);

            // Create sanctum token
            $token = $user->createToken('auth-token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        });
    }

    /**
     * Login user
     */
    public function login(array $credentials): array
    {
        $user = $this->userRepository->verifyCredentials(
            $credentials['email'],
            $credentials['password']
        );

        if (!$user) {
            throw new \Exception('Invalid credentials', 401);
        }

        // Delete existing tokens (optional - for single device login)
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout($user): bool
    {
        return $user->currentAccessToken()->delete();
    }

    public function verifyEmail($id): bool
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return false;
        }

        // Mark email as verified
        $this->userRepository->markEmailAsVerified($user);

        return true;
    }
}
