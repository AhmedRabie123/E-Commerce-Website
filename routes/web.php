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
 

// Admin routes

route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect')->middleware('auth','verified');

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


// order route

route::get('/show-order', [AdminController::class, 'show_order'])->name('order');
route::get('/delivered/{id}', [AdminController::class, 'delivered'])->name('delivered');

// order pdf route

route::get('/print-pdf/{id}', [AdminController::class, 'print_pdf'])->name('print_pdf');

// order send email route

route::get('/send-email/{id}', [AdminController::class, 'send_email'])->name('send_email');
Route::post('/user/email-submit/{id}',[AdminController::class, 'email_submit'])->name('email_submit');

// order search route

route::get('/search-order', [AdminController::class, 'search_order'])->name('search_order');


// front routes

// product Detail Page
Route::get('/product-detail/{id}', [HomeController::class, 'detail'])->name('product_detail');

// add to cart Page

Route::post('/add-cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show-cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::get('/remove-cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');


// order section route

Route::get('/cash-order', [HomeController::class, 'cash_order'])->name('cash_order');

// Stripe section route

Route::get('/stripe/{total_price}', [HomeController::class, 'stripe'])->name('stripe');
Route::post('/stripe/{total_price}',[HomeController::class, 'stripePost'])->name('stripe.post');


// show order && remove order route

Route::get('/user/show-order', [HomeController::class, 'show_user_order'])->name('show_user_order');
Route::get('/cancel-order/{id}', [HomeController::class, 'cancel_order'])->name('cancel_order');

// Comment && Reply route

Route::post('/add-comment', [HomeController::class, 'add_comment'])->name('add_comment');
Route::post('/add-reply', [HomeController::class, 'add_reply'])->name('add_reply');

// product search in home page route

route::get('/search-product', [HomeController::class, 'search_product'])->name('search_product');

// product search in product page route

route::get('/product-search', [HomeController::class, 'product_search'])->name('product_search');

// product all route

route::get('/all-products', [HomeController::class, 'all_product'])->name('all_product');



