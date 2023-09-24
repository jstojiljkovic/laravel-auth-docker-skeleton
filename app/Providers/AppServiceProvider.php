<?php

namespace App\Providers;

use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\SocialServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\AccountService;
use App\Services\AuthService;
use App\Services\UserService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AccountServiceInterface::class, AccountService::class);
        $this->app->bind(SocialServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
