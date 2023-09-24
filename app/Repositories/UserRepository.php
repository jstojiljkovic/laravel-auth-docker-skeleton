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
    public function getByEmail(string $email): array
    {
        $user = User::where('email', $email)->get();

        return UserResource::make($user)->resolve();
    }

    /**
     * @inheritDoc
     */
    public function createSocial(array $data): array
    {
        $user = User::find($data['user_id'])
            ->socials()
            ->create($data);

        return UserResource::make($user)->resolve();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::create($data);

        return UserResource::make($user)->resolve();
    }

    /**
     * @inheritDoc
     */
    public function getAuthUser(int $id): User
    {
        return User::find($id);
    }
}
