<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('home');

Route::get('/all-products', [ProductsController::class, 'allProducts'])->name('allProducts');

Route::get('/{categorySlug}', [ProductsController::class, 'category'])->name('category');

Route::get('/{categorySlug}/{productId}', [ProductController::class, 'index'])->name('product');
