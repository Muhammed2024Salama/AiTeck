<?php

use App\Http\Controllers\Api\Authentications\Controllers\AuthController;
use App\Http\Controllers\Api\Category\Controllers\CategoryController;
use App\Http\Controllers\Api\Comments\Controllers\CommentController;
use App\Http\Controllers\Api\PostCategory\Controllers\PostCategoryController;
use App\Http\Controllers\Api\Posts\Controllers\PostController;
use App\Http\Controllers\Api\PostTag\Controllers\PostTagController;
use App\Http\Controllers\Api\Tags\Controllers\TagController;
use App\Http\Controllers\Api\Users\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


/**
 * Authentication Routes
 * These routes are used for user registration, login, and profile management.
 */
Route::controller(AuthController::class)->group(function () {
    // Public routes
    Route::post('register', 'register');
    Route::post('login', 'login');

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', 'userProfile');
        Route::get('logout', 'userLogout');
    });
});

/**
 * Grouping Routes that require authentication
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * Users Routes
     */
    Route::apiResource('users', UserController::class);

    /**
     * Post Routes
     * (CRUD operations with role-based access
     * control can be handled in
     * the controller)
     **/
    Route::apiResource('posts', PostController::class);

    /**
     * Category Routes
     **/
    Route::apiResource('categories', CategoryController::class);

    /**
     * Tag Routes (Admins only)
     **/
    Route::apiResource('tags', TagController::class);

    /**
     * Comment Routes (Authenticated users can add comments)
     **/
    Route::apiResource('posts.comments', CommentController::class)->shallow();

    /**
     * Post-Category Relationships
     * Manage the relationship between posts and categories.
     */
    Route::prefix('/posts/{post}/categories')->group(function () {
        Route::post('/', [PostCategoryController::class, 'attachCategory']);
        Route::delete('/{category}', [PostCategoryController::class, 'detachCategory']);
        Route::put('/update', [PostCategoryController::class, 'updateCategory']);
        Route::get('/', [PostCategoryController::class, 'showCategories']);
    });

    /**
     * Post-Tag Relationships
     * Manage the relationship between posts and tags.
     */
    Route::prefix('/posts/{post}/tags')->group(function () {
        Route::post('/', [PostTagController::class, 'attachTag']);
        Route::delete('/{tag}', [PostTagController::class, 'detachTag']);
        Route::put('/update', [PostTagController::class, 'updateTag']);
        Route::get('/', [PostTagController::class, 'showTags']);
    });
});
