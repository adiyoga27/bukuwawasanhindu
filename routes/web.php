<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\CategoryArticleController;
use App\Http\Controllers\Admin\PageAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Auth\AuthController;
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'verify']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('contact',[PageController::class, 'contact']);
Route::get('articles', [PageController::class, 'articles']);
Route::get('articles/{slug}', [PageController::class, 'articlesDetail']);
Route::prefix('admin')->middleware('auth')->group(function () {
   Route::get('/', [PageAdminController::class, 'index'])->name('admin.home');
   Route::resource('categories', CategoryAdminController::class);
   Route::resource('products', ProductAdminController::class);
   Route::get('configs', [WebsiteController::class,'index']);
   Route::post('configs', [WebsiteController::class,'store']);
   Route::resource('category-article', CategoryArticleController::class);
   Route::resource('articles', ArticleController::class);
   Route::get('report/google-analytics', [ReportController::class, 'googleAnalytics']);
   Route::get('report/google-analytics/data', [ReportController::class, 'getAnalyticsData']);
   Route::post('/products/gallery', [ProductGalleryController::class, 'store'])->name('product.gallery.store');
Route::post('/products/gallery/delete', [ProductGalleryController::class, 'destroy'])->name('product.gallery.destroy');
});


