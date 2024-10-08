<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('/category/{id}', 'show');
    Route::post('/category', 'store');
    Route::put('/category/{id}', 'update');
    Route::delete('/category/{id}', 'destroy');
});

Route::controller(ProductController::class)->group(function () {
  Route::get('/product', 'index');
  Route::get('/product/{id}', 'show');
  Route::post('/product', 'store');
  Route::put('/product/{id}', 'update');
  Route::delete('/product/{id}', 'destroy');
});

