<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\API\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'ability:level1,level2'])->group(function () {
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups/{group}', [GroupController::class, 'show']);
    Route::get('/groups/{group}/customers', [GroupController::class, 'listCustomers']);
    Route::post('/groups/{group}/customers/{customer}', [GroupController::class, 'addCustomers']);
    Route::delete('/groups/{group}/customers/{customer}', [GroupController::class, 'removeCustomers']);

    Route::middleware('ability:level2')->group(function () {
        Route::post('/groups', [GroupController::class, 'store']);
        Route::put('/groups/{group}', [GroupController::class, 'update']);
        Route::delete('/groups/{group}', [GroupController::class, 'destroy']);
    });
});

Route::get('/groups', [GroupController::class, 'index']);
