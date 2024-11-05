<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index']);

Route::group(['prefix' => 'categories'], function() {
    Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
});

Route::group(['prefix' => 'genres'], function() {
    Route::get('/index', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/store', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/show/{genre}', [GenreController::class, 'show'])->name('genres.show');
    Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::patch('/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/{genre}', [GenreController::class, 'delete'])->name('genres.delete');
});
