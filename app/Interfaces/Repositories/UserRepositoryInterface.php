<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;

    /**
     * @param string $email
     *
     * @return array
     */
    public function getByEmail(string $email): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function createSocial(array $data): array;

    /**
     * @param int $id
     *
     * @return User
     */
    public function getAuthUser(int $id): User;
}
