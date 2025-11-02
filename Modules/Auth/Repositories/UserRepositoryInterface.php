<?php

namespace Modules\Auth\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;

    public function create(array $data): User;

    public function update(User $user, array $data): User;


    public function verifyCredentials(string $email, string $password): ?User;

    public function markEmailAsVerified(User $user): bool;

    public function isEmailVerified(User $user): bool;

}
