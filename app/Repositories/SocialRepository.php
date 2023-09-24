<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SocialRepositoryInterface;
use App\Models\Social;

class SocialRepository implements SocialRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function exists(string $providerId): bool
    {
        return Social::where('provider_id', $providerId)
            ->exists();
    }

    /**
     * @inheritDoc
     */
    public function get(string $providerId): array
    {
        return Social::where('provider_id', $providerId)->first()->toArray();
    }
}
