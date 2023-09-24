<?php

namespace App\Services;

use App\Interfaces\Repositories\SocialRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\SocialAccountServiceInterface;
use App\Interfaces\Services\SocialServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthServiceInterface, SocialServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;
    /**
     * @var SocialRepositoryInterface
     */
    private SocialRepositoryInterface $socialRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param SocialRepositoryInterface $socialRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, SocialRepositoryInterface $socialRepository)
    {
        $this->userRepository = $userRepository;
        $this->socialRepository = $socialRepository;
    }

    /**
     * @inheritDoc
     */
    public function getToken(array $data): array
    {
        abort_unless(Auth::attempt($data),
            Response::HTTP_UNAUTHORIZED, 'Unauthorised');

        $user = Auth::user();
        return $this->createToken($user);
    }

    /**
     * @param $user
     *
     * @return array
     */
    private function createToken($user): array
    {
        $token = $user->createToken('LaravelAuthToken');

        return [
            'access_token' => $token->accessToken,
            'token_type' => 'bearer',
            'expires_in' => $token->token->expires_at->timestamp
        ];
    }

    /**
     * @inheritDoc
     */
    public function redirectToProvider(string $provider): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @inheritDoc
     */
    public function handleProviderCallback(string $provider): array
    {
        $socialite = Socialite::driver($provider)->user();

        if (!$this->socialRepository->exists($socialite->getId())) {
            $data = [
                'username' => $socialite->getEmail(),
                'email' => $socialite->getEmail()
            ];
            $userId = $this->userRepository->create($data)['id'];

            $data = [
                'user_id' => $userId,
                'provider_id' => $socialite->getId(),
                'provider' => $provider
            ];

            $this->userRepository->createSocial($data);
        } else {
            $userId = $this->socialRepository->get($socialite->getId())['user_id'];
        }

        $user = $this->userRepository->getAuthUser($userId);

        Auth::login($user);
        return $this->createToken($user);
    }
}
