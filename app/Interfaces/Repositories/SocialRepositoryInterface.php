<?php

namespace App\Interfaces\Repositories;

interface SocialRepositoryInterface
{
    /**
     * @param string $providerId
     *
     * @return bool
     */
    public function exists(string $providerId): bool;

    /**
     * @param string $providerId
     *
     * @return array
     */
    public function get(string $providerId): array;
}
