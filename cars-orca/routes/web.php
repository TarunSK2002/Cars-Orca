<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\SellRequestController;
use App\Http\Controllers\Admin\ContactController;

// Customer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/sell-your-car', [HomeController::class, 'sellYourCar'])->name('sell');
Route::post('/sell-your-car', [HomeController::class, 'storeSellYourCar'])->name('sell.store');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/car/{id}', [CarDetailController::class, 'show'])->name('car.show');
Route::post('/car/{id}/enquire', [CarDetailController::class, 'storeEnquiry'])->name('car.enquire');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

use App\Http\Controllers\Admin\LoginController;

// Admin Authentication
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Car CRUD
    Route::resource('cars', CarController::class);
    
    // Enquiries
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::patch('/enquiries/{id}/status', [EnquiryController::class, 'updateStatus'])->name('enquiries.status');
    
    // Sell Requests
    Route::get('/sell-requests', [SellRequestController::class, 'index'])->name('sell-requests.index');
    Route::patch('/sell-requests/{id}/status', [SellRequestController::class, 'updateStatus'])->name('sell-requests.status');
    
    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::patch('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('contacts.status');
});
