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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {


    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::apiResource('/categories', CategoriesController::class);


    // Categories
    // create, show all, show detail, update, and delete


    // Use Token for Authentication to create and get resources
    Route::middleware('auth:api')->group(function () {

        // Posts/Articles
        // create, show all, show detail, update and delete must use token
        Route::apiResource('/posts', PostsController::class);

        // Route::post('/posts/create', [PostsController::class, 'store']);
        // Route::get('/posts', [PostsController::class, 'index']);
        // Route::get('/posts/{id}', [PostsController::class, 'show']);
    });
});
