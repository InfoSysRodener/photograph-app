<?php

namespace App\Providers;

use App\Interfaces\AlbumRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Respositories\UserRepository;
use App\Respositories\AlbumRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
