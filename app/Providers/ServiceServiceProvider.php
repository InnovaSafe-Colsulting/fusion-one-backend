<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Auth
use App\Services\Auth\AuthService;

class ServiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService(
                $app->make(\App\Repositories\Interfaces\Auth\AuthRepositoryInterface::class)
            );
        });
    }
}
