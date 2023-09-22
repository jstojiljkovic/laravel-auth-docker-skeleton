<?php

namespace App\Services;

use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthServiceInterface
{

    /**
     * @inheritDoc
     */
    public function getToken(array $data): array
    {
        abort_unless(Auth::attempt($data),
            Response::HTTP_UNAUTHORIZED, 'Unauthorised');

        $user = Auth::user();
        $token = $user->createToken('LaravelAuthToken');

        return [
            'access_token' => $token->accessToken,
            'token_type' => 'bearer',
            'expires_in' => $token->token->expires_at->timestamp
        ];
    }
}
