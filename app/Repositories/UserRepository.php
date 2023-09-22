<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return UserResource::make($user)->resolve();
    }
}
