<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebsiteController;

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

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    // websites
    Route::get('/websites', [WebsiteController::class, 'all']);
    Route::post('/websites', [WebsiteController::class, 'new']);
    Route::get('/websites/{id}', [WebsiteController::class, 'show']);
    Route::put('/websites/{id}', [WebsiteController::class, 'update']);
    // subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'all']);
    Route::post('/subscriptions', [SubscriptionController::class, 'new']);
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show']);
    Route::put('/subscriptions/{id}', [SubscriptionController::class, 'update']);
    Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'delete']);
    // posts
    Route::get('/posts', [PostController::class, 'all']);
    Route::post('/posts', [PostController::class, 'new']);
    Route::get('/posts/{id}', [PostController::class, 'show']);

});
