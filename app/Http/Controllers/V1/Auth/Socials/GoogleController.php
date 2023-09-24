<?php

namespace App\Http\Controllers\V1\Auth\Socials;

use App\Enums\SocialEnum;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\SocialServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GoogleController extends Controller
{
    /**
     * @var SocialServiceInterface
     */
    private SocialServiceInterface $socialService;

    /**
     * @param SocialServiceInterface $socialService
     */
    public function __construct(SocialServiceInterface $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function redirect(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return $this->socialService->redirectToProvider(SocialEnum::GOOGLE->value);
    }

    /**
     * @return JsonResponse
     */
    public function callback(): JsonResponse
    {
        $token = $this->socialService->handleProviderCallback(SocialEnum::GOOGLE->value);

        return response()->json([
            'data' => [
                'token' => $token
            ],
        ], ResponseAlias::HTTP_OK);
    }
}
