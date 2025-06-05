<?php

use App\Http\Controllers\API\V1\{AuthController, TaskController};
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',
], static function () {
    Route::group([
        'prefix' => 'auth',
        'as'     => 'auth.'
    ], static function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('user', [AuthController::class, 'user'])->name('user')->middleware('auth:sanctum');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
    });

    Route::group([
        'middleware' => ['auth:sanctum'],
        'prefix'     => 'tasks',
        'as'         => 'tasks.'
    ], static function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{task}', [TaskController::class, 'show'])->name('show');
        Route::post('/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskController::class, 'delete'])->name('delete');//can make custom binding baseTask for this
        Route::post('/{task}/done', [TaskController::class, 'markAsDone'])->name('markAsDone');//and this
    });
});
