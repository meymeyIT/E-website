<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlertController;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController as FrontCategoryController;
use App\Http\Controllers\Frontend\ProductController as FrontProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\AboutUsController;

/*
|--------------------------------------------------------------------------
| Frontend Public Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories
Route::get('/categories', [FrontCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [FrontCategoryController::class, 'show'])->name('categories.show');

// Products (Frontend)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [FrontProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [FrontProductController::class, 'show'])->name('show');
});

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout (requires login)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/thank-you', [CheckoutController::class, 'thankyou'])->name('thankyou');
});

// Contact Us
Route::get('/contact-us', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');

// About Us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about');

/*
|--------------------------------------------------------------------------
| User Dashboard (optional)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('home'); // Redirect normal users to home
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes (Requires Auth + IsAdmin Middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'IsAdmin'])->as('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Controllers
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class);

    // System Alerts
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::post('/alerts/{id}/read', [AlertController::class, 'markAsRead'])->name('alerts.read');
    Route::post('/alerts/read-all', [AlertController::class, 'markAllAsRead'])->name('alerts.readAll');

    // Product Images (nested routes)
    Route::prefix('products/{product}/images')->name('products.images.')->group(function () {
        Route::get('/', [ProductImageController::class, 'index'])->name('index');
        Route::get('/create', [ProductImageController::class, 'create'])->name('create');
        Route::post('/', [ProductImageController::class, 'store'])->name('store');
        Route::delete('/{image}', [ProductImageController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::get('/reports/sales', [ReportController::class, 'salesReport'])->name('reports.sales');
});
