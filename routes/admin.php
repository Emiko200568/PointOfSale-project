<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\AdminDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleInformationController;

Route::group(['middleware'=> 'adminMiddleware','auth','prefix'=>'admin'], function(){

    // Admin dashboard
   Route::get('/home',[AdminDashboard::class,'dashboard'])->name('admin#home');

    // Category routes
    Route::group(['prefix' => 'category'], function(){

        // List categories
        Route::get('/list', [CategoryController::class, 'list'])->name('category#list');

        // Show create form
        Route::get('/create', [CategoryController::class, 'create'])->name('category#create');

        // Handle form submission
        Route::post('/create', [CategoryController::class, 'store'])->name('category#store');

        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');

        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');

        Route::post('/update/{id}',[CategoryController::class,'update'])->name('category#update');

    });

    Route::group(['prefix' => 'product'], function(){
        // List product
        Route::get('/list', [ProductController::class, 'list'])->name('product#list');
        Route::get('/create', [ProductController::class, 'createPage'])->name('productCreate#list');
        Route::post('/create', [ProductController::class, 'create'])->name('product#create');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
      // Show edit form
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product#edit');

    // Handle update
        Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product#update');

        Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('product#detail');


    });

    Route::group(['prefix' => 'paymentMethod', 'middleware' => 'superAdminMiddleware'], function() {
        Route::get('/list', [PaymentController::class, 'list'])->name('paymentMethod#list');
        Route::post('/create', [PaymentController::class, 'create'])->name('paymentMethod#create');
        Route::get('/delete/{id}', [PaymentController::class, 'delete'])->name('paymentMethod#delete');
        Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('paymentMethod#edit');
        Route::post('/update/{id}', [PaymentController::class, 'update'])->name('paymentMethod#update');
    });



    Route::group(['prefix'=>'profile'],function(){
       Route::get('/detail',[AdminProfileController::class,'detail'])->name('profile#detail');
       Route::get('/edit',[AdminProfileController::class,'edit'])->name('profile#edit');
       Route::post('/update/{id}',[AdminProfileController::class,'update'])->name('profile#update');
       Route::get('/changePasswordPage',[AdminProfileController::class,'changePasswordPage'])->name('profile#changePasswordPage');
       Route::post('/changePassword',[AdminProfileController::class,'changePassword'])->name('profile#changePassword');


       Route::group(['middleware' => 'superAdminMiddleware'], function(){
        Route::get('/addNewAdminPage',[AdminProfileController::class,'addNewAdminPage'])->name('profile#addNewAdminPage');
        Route::post('/addNewAdmin',[AdminProfileController::class,'addNewAdmin'])->name('profile#addNewAdmin');
        Route::get('/adminList',[AdminProfileController::class,'adminList'])->name('profile#adminList');
        Route::get('/userList',[AdminProfileController::class,'userList'])->name('profile#userList');
        Route::get('/delete/{id}',[AdminProfileController::class,'delete'])->name('profile#delete');
       });
    });

    //order
    Route::group(['prefix'=>'order'],function(){
        Route::get('list/{state?}',[OrderController::class,'orderList'])->name('admin#orderList');
        Route::get('detail/{orderCode}',[OrderController::class,'orderDetail'])->name('admin#orderDetail');
        Route::get('reject/{orderCode}',[OrderController::class,'orderReject'])->name('admin#orderReject');
        Route::post('accept', [OrderController::class,'orderAccept'])->name('admin#orderAccept');
    });

    //sale
    Route::group(['prefix'=>'order'],function(){
        Route::get('information',[SaleInformationController::class,'saleInformation'])->name('admin#saleInfo');
        });


     //contact
     Route::group(['prefix'=>'contact'],function(){
        Route::get('contactList',[ContactController::class,'contactList'])->name('admin#contactList');
        });


    //action logs
    Route::group(['prefix'=>'action'],function(){
        Route::get('actionLogs',[ActionLogController::class,'actionLogs'])->name('admin#actionLogs');
        });



});
