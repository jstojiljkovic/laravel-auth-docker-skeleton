<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * @var AccountServiceInterface
     */
    private AccountServiceInterface $accountService;

    /**
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService, AccountServiceInterface $accountService)
    {
        $this->authService = $authService;
        $this->accountService = $accountService;
    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->getToken($request->validated());

        return response()->json([
            'data' => [
                'token' => $token
            ],
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @param ForgotPasswordRequest $request
     *
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $status = $this->accountService->forgotPassword($request->only('email'));

        return response()->json([
            'message' => $status
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @param ResetPasswordRequest $request
     *
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $status = $this->accountService->resetPassword($request->validated());

        return response()->json([
            'message' => $status
        ], ResponseAlias::HTTP_OK);
    }
}
