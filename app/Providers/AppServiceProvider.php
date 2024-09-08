<?php

namespace App\Providers;

use App\Http\Controllers\Api\Authentications\Interface\AuthInterface;
use App\Http\Controllers\Api\Authentications\Repository\AuthRepository;
use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Repository\CategoryRepository;
use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Repository\TagRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
