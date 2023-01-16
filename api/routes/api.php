<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function(){

    Route::post('login', [AuthController::class, 'login']);
    
    Route::post('register', [AuthController::class, 'register']);

    Route::post('verify-email', [AuthController::class, 'verifyEmail']);

    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

    Route::post('reset-password', [AuthController::class, 'resetPassword']);



    Route::prefix('me')->group(function(){
        
        Route::get('', [MeController::class, 'index']);

        Route::put('', [MeController::class, 'update']);
    });

    Route::prefix('todos')->group(function(){
        
        Route::get('', [TodoController::class, 'index']);
        /* tasks */
        Route::get('{todo}', [TodoController::class, 'show']);

        Route::post('', [TodoController::class, 'store']);

        Route::put('{todo}', [TodoController::class, 'update']);
        
        Route::delete('{todo}', [TodoController::class, 'destroy']);
        /* tasks */
        Route::post('{todo}/tasks', [TodoController::class, 'addTask']);

    });

   

});

