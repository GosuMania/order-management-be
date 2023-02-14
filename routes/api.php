<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login',  [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::get('get-all', [AuthController::class, 'getAll']);
    Route::get('get-all-with-pagination/{page}', [AuthController::class, 'getAllWithPagination']);
});

Route::controller(CustomerController::class)->prefix('customer')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
});
