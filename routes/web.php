<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('Home/Index');
});
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('product.details');

Route::get('/shop', [ProductController::class, 'index'])->name('shop.products');

Route::get('/cart', function () {
    return Inertia::render('Cart/Index');
});

Route::get('/blogs', function () {
    return inertia::render('Blog/Index');
});

Route::get('/wishlist', function () {
    return Inertia::render('Wishlist/Index');
});


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
Route::get('/settings', function () {
    return Inertia::render('Account/Settings');
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware('auth')->group(function () {
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
Route::get('/show-product/{product}', [SecondProduct::class, 'index' ])->name('product.show');

Route::get('/product/{product}/edit', [SecondProduct::class, 'edit'])->name('product.edit');

Route::delete('/product/{product}', [SecondProduct::class, 'delete'])->name('product.delete');
