<?php

use App\Http\Controllers\Api\Authentications\Controllers\AuthController;
use App\Http\Controllers\Api\Category\Controllers\CategoryController;
use App\Http\Controllers\Api\Role\Controllers\RoleController;
use App\Http\Controllers\Api\Tags\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
     * Roles Routes (Authenticated users can add Roles)
     */
    Route::apiResource('roles', RoleController::class);

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
});
