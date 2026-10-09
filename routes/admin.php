<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;


Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');


    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'admin'])->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::resource('products', AdminProductController::class)
            ->names('products');


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', AdminCategoryController::class)
            ->names('categories');


        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])
            ->name('orders.update');


        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        Route::get('/customers', [AdminCustomerController::class, 'index'])
            ->name('customers.index');

        Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])
            ->name('customers.show');


        /*
        |--------------------------------------------------------------------------
        | Blogs
        |--------------------------------------------------------------------------
        */

        Route::resource('blogs', AdminBlogController::class)
            ->names('blogs');


        /*
        |--------------------------------------------------------------------------
        | Contact Messages
        |--------------------------------------------------------------------------
        */

        Route::get('/contacts', [AdminContactController::class, 'index'])
            ->name('contacts.index');

        Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])
            ->name('contacts.show');


        /*
        |--------------------------------------------------------------------------
        | Admin Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('profile');

        Route::put('/profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');

    });

});