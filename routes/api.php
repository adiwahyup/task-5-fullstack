<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {

    // Register and login
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Route to create, show all, show detail, update, and delete Categories

    Route::apiResource('/categories', CategoriesController::class);




    // Use Token for Authentication to create and get resources
    Route::middleware('auth:api')->group(function () {

        // Posts/Articles
        // Route to create, show all, show detail, update, and delete Posts
        // Must authenticated by either login or register to get token
        // Use token Authorization Bearer Token

        Route::apiResource('/posts', PostsController::class);
    });
});
