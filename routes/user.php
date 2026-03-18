<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'userMiddleware', 'prefix' => 'user'], function() {
    Route::get('/home', [UserController::class, 'home'])->name('user#home');
    Route::get('/product/details/{id}', [UserController::class, 'productDetails'])->name('user#details');
    Route::post('/product/comment/{id}',[UserController::class,'comment'])->name('user#comment');
    Route::get('/comment/delete/{id}',[UserController::class,'commentDelete'])->name('user#commentDelete');
    Route::post('/rating',[UserController::class,'rating'])->name('user#rating');
    Route::get('/cart', [UserController::class, 'cart'])->name('user#cart');
    Route::post('/addToCart',[UserController::class,'addToCart'])->name('user#addToCart');
    Route::post('/deleteCart', [UserController::class, 'deleteCart'])->name('user#deleteCart');
    Route::get('/paymentPage', [UserController::class, 'paymentPage'])->name('user#paymentPage');
    Route::post('/cartTemp', [UserController::class, 'cartTemp'])->name('user#cartTemp');
    Route::post('/payment', [UserController::class, 'payment'])->name('user#payment');
    Route::get('/orderList', [UserController::class, 'orderList'])->name('user#orderList');
    Route::get('/readMore', [UserController::class, 'readMore'])->name('user#readMore');
    Route::get('/team', [UserController::class, 'team'])->name('user#team');
});

Route::group(['middleware' => 'userMiddleware', 'prefix' => 'user'], function() {
    Route::get('/detail',[UserProfileController::class,'detail'])->name('user#detail');
    Route::get('/edit',[UserProfileController::class,'edit'])->name('user#edit');
    Route::post('/update{id}',[UserProfileController::class,'update'])->name('user#update');
    Route::get('/changePasswordPage',[UserProfileController::class,'changePasswordPage'])->name('user#changePasswordPage');
    Route::post('/changePassword',[UserProfileController::class,'changePassword'])->name('user#changePassword');
});

Route::group(['middleware' => 'userMiddleware', 'prefix' => 'user'], function () {

    // show contact page
    Route::get('/contact', [ContactController::class, 'contactPage'])->name('user#contactPage');

    // submit contact form
    Route::post('/contact', [ContactController::class, 'contact'])->name('user#contact');
});

