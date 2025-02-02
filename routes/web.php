<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/index', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'delete'])->name('products.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/show/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
    });

    Route::group(['prefix' => 'genres'], function () {
        Route::get('/index', [GenreController::class, 'index'])->name('genres.index');
        Route::get('/create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('/store', [GenreController::class, 'store'])->name('genres.store');
        Route::get('/show/{genre}', [GenreController::class, 'show'])->name('genres.show');
        Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::patch('/{genre}', [GenreController::class, 'update'])->name('genres.update');
        Route::delete('/{genre}', [GenreController::class, 'delete'])->name('genres.delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'delete'])->name('users.delete');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/index', [OrderController::class, 'index'])->name('orders.index');
        
    });
});

Auth::routes();

Route::get('/{page}', IndexController::class)->where('page', '.*')->name('default');