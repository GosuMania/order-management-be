<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ClothingSizeController;
use App\Http\Controllers\ShoeSizeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeasonTypeController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;


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
    Route::get('get-all-with-pagination-search/{word}/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPaginationSearch');
});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
    Route::get('get-all-with-pagination-search/{word}/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPaginationSearch');
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

Route::controller(ImageProductController::class)->prefix('image')->group(function () {
    Route::post('upload', 'upload'); // restituisce la lista
});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});

Route::controller(DeliveryController::class)->prefix('delivery')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(OrderTypeController::class)->prefix('order-type')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(PaymentMethodsController::class)->prefix('payment-method')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(SeasonTypeController::class)->prefix('season-type')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(SeasonController::class)->prefix('season')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
});

Route::controller(OrderController::class)->prefix('order')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::get('get-all-with-pagination/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPagination');
    Route::get('get-all-with-pagination-search/{word}/{orderBy}/{ascDesc}/{perPage}/{page}', 'getAllWithPaginationSearch');
    Route::get('get-total-pieces-and-amounts', 'getTotalPiecesAndAmounts'); // restituisce una specifica
});

Route::controller(OrderProductController::class)->prefix('order-product')->group(function () {
    Route::get('get-by-id-order', 'getByIdOrder'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
    Route::delete('delete-by-id-order/{id}', 'deleteByIdOrder'); // elimina
});

