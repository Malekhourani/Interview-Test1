<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register',  [AuthController::class, 'register']);
    Route::group([
        'middleware' => 'auth'
    ], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user',  [AuthController::class, 'user']);
    });
});

Route::middleware('auth')
    ->group(function () {

        Route::middleware(['verify-user-type:editor', 'set-blog-type'])
            ->group(function () {
                Route::patch('blog', [BlogController::class, 'update']);
                Route::delete('blog', [BlogController::class, 'destroy']);
            });

        Route::apiResource('blog', BlogController::class);
        Route::apiResource('comment', CommentController::class);
    });
