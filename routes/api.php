<?php

use App\Http\Controllers\API\Product\FilterController;
use App\Http\Controllers\API\Product\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'products'], function() {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/show/{product}', [ProductsController::class, 'show']);
    Route::get('/filter', FilterController::class);
});
