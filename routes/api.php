<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Product\FilterController;
use App\Http\Controllers\API\Product\ProductsController;
use App\Http\Controllers\API\Product\FilterListController;
use App\Http\Controllers\Auth\AuthCheckController;

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
});
