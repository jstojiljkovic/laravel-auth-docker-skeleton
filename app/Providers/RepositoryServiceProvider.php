<?php

namespace App\Providers;

use App\Interfaces\Repositories\SocialRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\SocialRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SocialRepositoryInterface::class, SocialRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
