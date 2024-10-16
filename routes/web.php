<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () { 
    return view('login.index',[
        'title' => 'Login'
       ] );
});

// login

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);




Route::group(['middleware' => ['auth', 'ceklevel:admin,superAdmin']], function() {
    //  user
    
    Route::get('/home', function () {
        return view('users/home');
    });
    
    Route::get('/products', [LoanController::class, 'index'])->name('products.index');
    Route::post('/submit-loan', [LoanController::class, 'store'])->name('submit-loan');

    Route::get('/status', [LoanController::class, 'userLoans'])->name('status.loans');
    Route::get('/status/{transaction}', [LoanController::class, 'showLoans'])->name('loan.show');
    Route::post('/return/{transaction_id}', [LoanController::class, 'return'])->name('loan.return');


    Route::get('/history', [LoanController::class, 'history'])->name('loans.history');


    Route::get('/admin', function () { 
        return view('admin.homeAdmin',[] );
    });
    
    Route::get('/listProduct', [AdminController::class, 'listProducts'])->name('admin.listProducts');
    Route::post('/listproduct', [AdminController::class, 'addProducts'])->name('products.store');
    Route::put('/listProduct/{id}', [AdminController::class, 'updateProducts'])->name('products.update');
    Route::delete('/lisProduct/delete/{id}', [AdminController::class, 'destroyProduct'])->name('delete.product');
    

    
});


Route::group(['middleware' => ['auth','ceklevel:superAdmin']], function(){
    Route::get('/listUser', [AdminController::class, 'listUser'])->name('admin.listUser');
    Route::post('/listusers', [AdminController::class, 'addUser'])->name('users.store');
    Route::put('/listUser/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/lisUser/delete/{id}', [AdminController::class, 'destroyUser'])->name('delete.user');

});



