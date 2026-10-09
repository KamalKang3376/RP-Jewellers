<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\BlogController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;


Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/account', [AccountController::class, 'index'])
    ->middleware('auth')
    ->name('account');

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::post('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::middleware('auth')->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

    Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])
        ->name('wishlist.remove');

});

Route::get('/collections', [CollectionController::class, 'index'])
    ->name('collections');

Route::get('/about', [AboutController::class, 'index'])
    ->name('about');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog');

Route::get('/blog/{slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit');



//
Route::get('/test-mail', function () {

    Mail::to('test@example.com')->send(new TestMail());

    return 'Test email sent successfully!';
});

//
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])
    ->name('otp.verify');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('otp.verify.submit');

Route::post('/resend-otp', [AuthController::class, 'resendOtp'])
    ->name('otp.resend');