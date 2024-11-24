<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityController;


Route::get('/', function () { 
    return view('login.index',[
       ] );
});

// login

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);




Route::group(['middleware' => ['auth', 'ceklevel:admin,superAdmin']], function() {
    //  admin and super admin
    
    Route::get('/home', [ProductController::class, 'showHome'])->name('transactions.chart');

    Route::get('/products', [LoanController::class, 'index'])->name('products.index');
    Route::post('/submit-loan', [LoanController::class, 'store'])->name('submit-loan');

    Route::get('/status', [LoanController::class, 'userLoans'])->name('status.loans');
    Route::get('/status/{transaction}', [LoanController::class, 'showLoans'])->name('loan.show');
    Route::post('/return/{transaction_id}', [LoanController::class, 'return'])->name('loan.return');
    

    Route::get('/history', [LoanController::class, 'history'])->name('loans.history');
    Route::get('/history/export', [LoanController::class, 'export'])->name('loans.export');

//dashboard
    
    Route::get('/profile', [AdminController::class, 'showHomeAdmin']);
    Route::put('/profile/{id}', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/activity-logs', [ActivityController::class, 'index'])->name('activity-logs.index');




    Route::get('/listProduct', [AdminController::class, 'listProducts'])->name('admin.listProducts');
    Route::post('/listproduct', [AdminController::class, 'addProducts'])->name('products.store');
    Route::put('/listProduct/{id}', [AdminController::class, 'updateProducts'])->name('products.update');
    Route::delete('/lisProduct/delete/{id}', [AdminController::class, 'destroyProduct'])->name('delete.product');
    Route::post('/products/remove', [AdminController::class, 'bulkDelete'])->name('products.remove');
    Route::post('/products/import', [AdminController::class, 'importProduct'])->name('products.import');
    Route::get('/products/export', [AdminController::class, 'exportProduct'])->name('products.export');
    

    
});

//super admin only
Route::group(['middleware' => ['auth','ceklevel:superAdmin']], function(){
    Route::get('/listUser', [AdminController::class, 'listUser'])->name('admin.listUser');
    Route::post('/listusers', [AdminController::class, 'addUser'])->name('users.store');
    Route::put('/listUser/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/lisUser/delete/{id}', [AdminController::class, 'destroyUser'])->name('delete.user');

});





