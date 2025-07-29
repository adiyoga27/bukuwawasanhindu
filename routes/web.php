<?php

use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\PageAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Guest\BookController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/book', [BookController::class, 'index'])->name('book');
Route::get('/product/{slug}', [BookController::class, 'show']);
Route::get('/categories/{slug}', [BookController::class, 'showByCategory']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


Route::prefix('admin')->group(function () {
   Route::get('/', [PageAdminController::class, 'index'])->name('admin.home');
   Route::resource('categories', CategoryAdminController::class);
   // Route::resource('products', ProductAdminController::class);
});


