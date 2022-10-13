<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

route::get('/home', [AdminController::class, 'index'])->name('home');

// category route

route::get('/show-category', [AdminController::class, 'show_category'])->name('category');
Route::get('/category-create',[AdminController::class, 'category_create'])->name('category_create');
Route::post('/category-store',[AdminController::class, 'category_store'])->name('category_store');
Route::get('/category-edit/{id}',[AdminController::class, 'category_edit'])->name('category_edit');
Route::post('/category-update/{id}',[AdminController::class, 'category_update'])->name('category_update');
Route::get('/category-delete/{id}',[AdminController::class, 'category_delete'])->name('category_delete');

// product route

route::get('/show-product', [AdminController::class, 'show_product'])->name('product');
Route::get('/product-create',[AdminController::class, 'product_create'])->name('product_create');
Route::post('/product-store',[AdminController::class, 'product_store'])->name('product_store');
Route::get('/product-edit/{id}',[AdminController::class, 'product_edit'])->name('product_edit');
Route::post('/product-update/{id}',[AdminController::class, 'product_update'])->name('product_update');
Route::get('/product-delete/{id}',[AdminController::class, 'product_delete'])->name('product_delete');


// product Detail Page
Route::get('/product-detail/{id}', [HomeController::class, 'detail'])->name('product_detail');


// add to cart Page

Route::post('/add-cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show-cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::get('/remove-cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');

// order section route

Route::get('/cash-order', [HomeController::class, 'cash_order'])->name('cash_order');

