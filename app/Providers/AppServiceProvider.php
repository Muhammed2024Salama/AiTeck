<?php

namespace App\Providers;

use App\Http\Controllers\Api\Authentications\Interface\AuthInterface;
use App\Http\Controllers\Api\Authentications\Repository\AuthRepository;
use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Repository\CategoryRepository;
use App\Http\Controllers\Api\Comments\Interface\CommentInterface;
use App\Http\Controllers\Api\Comments\Repository\CommentRepository;
use App\Http\Controllers\Api\Posts\Interface\PostInterface;
use App\Http\Controllers\Api\Posts\Repository\PostRepository;
use App\Http\Controllers\Api\PostTag\Interface\PostTagInterface;
use App\Http\Controllers\Api\PostTag\Repository\PostTagRepository;
use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Repository\TagRepository;
use App\Http\Controllers\Api\Users\Interface\UserInterface;
use App\Http\Controllers\Api\Users\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(CommentInterface::class, CommentRepository::class);
        $this->app->bind(PostTagInterface::class, PostTagRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
