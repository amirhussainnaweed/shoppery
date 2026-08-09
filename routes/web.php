<?php

use App\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index');
});
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('product.details');

Route::get('/shop', [ProductController::class, 'index'])->name('shop.products');

Route::get('/cart', function () {
    return Inertia::render('Cart/Index');
});

Route::get('/blogs', function () {
    return Inertia::render('Blog/Index');
});

Route::get('/blogs/singleBlog', function () {
    return Inertia::render('Blogs/SingleBlock');
});


Route::post('/cart/add/{productid}', [CartController::class, 'addToCart'])->middleware('auth');

Route::get('/checkout', function () {
    return Inertia::render('Checkout/Index');
});

Route::get('/about', function () {
    return Inertia::render('About/Index');
});

Route::get('/contact', function () {
    return Inertia::render('Contact/Index');
});
Route::get('/orders', function () {
    return Inertia::render('OrderHistory/Index');
});
Route::get('/order-details', function () {
    return Inertia::render('OrderHistory/OrderDetails');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [AccountController::class, 'index']);
    Route::put('/settings', [AccountController::class, 'update']);
    Route::put('/settings/billing', [AccountController::class, 'updateBilling']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function () {
    return Inertia::render('Errors/NotFound')
        ->toResponse(request())
        ->setStatusCode(404);
});
require __DIR__.'/auth.php';

// fake routes
Route::get('/show-product/{product}', [SecondProduct::class, 'index'])->name('product.show');

Route::get('/product/{product}/edit', [SecondProduct::class, 'edit'])->name('product.edit');

Route::delete('/product/{product}', [SecondProduct::class, 'delete'])->name('product.delete');
