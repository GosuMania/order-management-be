<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ClothingSizeController;
use App\Http\Controllers\ShoeSizeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductTypeController;


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
});

Route::controller(CustomerController::class)->prefix('customer')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});

Route::controller(ProductVariantController::class)->prefix('product')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});

Route::controller(ColorController::class)->prefix('color')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(ClothingSizeController::class)->prefix('clothing-size')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(ShoeSizeController::class)->prefix('shoe-size')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(ProviderController::class)->prefix('provider')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});

Route::controller(ProductTypeController::class)->prefix('product-type')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});
