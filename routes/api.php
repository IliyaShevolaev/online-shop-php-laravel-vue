<?php

use App\Http\Controllers\API\Product\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Product\FilterController;
use App\Http\Controllers\API\Product\ProductsController;
use App\Http\Controllers\API\Product\FilterListController;
use App\Http\Controllers\API\Product\OrderController;
use App\Http\Controllers\API\Profile\AuthCheckController;
use App\Http\Controllers\API\Profile\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/is-authorized', AuthCheckController::class);

Route::group(['prefix' => 'products'], function() {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/show/{product}', [ProductsController::class, 'show']);
    
    Route::get('/filter/list', FilterListController::class);
    Route::post('/filter', FilterController::class);
    Route::get('/favorites/index', [FavoriteController::class, 'index']);
    Route::post('/favorites/add', [FavoriteController::class, 'create']);

});

Route::group(['prefix' => 'profile'], function() {
    Route::get('/', [ProfileController::class, 'index']);
    Route::post('/edit', [ProfileController::class, 'edit']);
});

Route::group(['prefix' => 'orders'], function() {
    Route::get('/index', [OrderController::class, 'index']);
    Route::post('/create', [OrderController::class, 'create']);

});
