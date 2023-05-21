<?php

use App\Http\Controllers as Api;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [Api\UserController::class, 'show']);

    Route::prefix('/quizzes')->group(function () {
        Route::get('/', [Api\QuizController::class, 'index']);
        Route::get('/{quiz}', [Api\QuizController::class, 'show']);
        Route::post('/', [Api\QuizController::class, 'store']);
    });
});
