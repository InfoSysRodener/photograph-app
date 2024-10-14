<?php

namespace App\Providers;

use App\Interfaces\AlbumRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CaptureRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\CaptureRepository;

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
        $this->app->bind(CaptureRepositoryInterface::class, CaptureRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
