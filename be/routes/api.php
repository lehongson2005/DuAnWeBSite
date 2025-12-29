<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    // Auth routes
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('auth.provider.redirect');
        Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('auth.provider.callback');
    });

    // Resource routes
    Route::apiResource('events', EventController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('events.comments', CommentController::class)->shallow();
});
