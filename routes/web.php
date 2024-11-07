<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/index', [AdminController::class, 'index']);

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
});
