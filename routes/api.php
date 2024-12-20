<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Product\CartController;
use App\Http\Controllers\API\Product\FilterController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\Product\FavoriteController;
use App\Http\Controllers\API\Product\ProductsController;
use App\Http\Controllers\API\Profile\AuthCheckController;
use App\Http\Controllers\API\Product\FilterListController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get', function () {
    return 'Auth!';
})->middleware('auth:sanctum');

Route::get('/is-authorized', AuthCheckController::class);

Route::group(['prefix' => 'products'], function() {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/show/{product}', [ProductsController::class, 'show']);

    Route::get('/filter/list', FilterListController::class);
    Route::post('/filter', FilterController::class);

    Route::get('/favorites/index', [FavoriteController::class, 'index']);
    Route::post('/favorites/add', [FavoriteController::class, 'create']);

    Route::get('/cart/index', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('/', [ProfileController::class, 'index']);
    Route::post('/edit', [ProfileController::class, 'edit']);
});
