<?php

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

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/home', function () {
    return view('users/home');
});


Route::group(['middleware' => ['auth','ceklevel:user']], function(){
    //  user

    Route::get('/products', [LoanController::class, 'index'])->name('products.index');
    Route::post('/submit-loan', [LoanController::class, 'store'])->name('submit-loan');

    Route::get('/status', [LoanController::class, 'userLoans'])->name('status.loans');
    Route::get('/status/{transaction}', [LoanController::class, 'showLoans'])->name('loan.show');
    Route::post('/return/{transaction_id}', [LoanController::class, 'return'])->name('loan.return');





    Route::get('/history', [LoanController::class, 'history'])->name('loans.history');
    

    
});


Route::group(['middleware' => ['auth','ceklevel:admin']], function(){
    // admin
   

});