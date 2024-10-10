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

    Route::get('/status', [LoanController::class, 'userLoans'])->name('loans.user')->middleware('auth');
    Route::get('/status/{userName}', [LoanController::class, 'showLoans'])->name('loans.show');
    Route::post('/return/{user_name}', [LoanController::class, 'return'])->name('loan.return');




    Route::get('/history', [LoanController::class, 'history'])->name('loans.history');
    Route::get('/loan/details/{userName}/{borrowedAt}', [LoanController::class, 'showDetails'])->name('loan.details');

    
});


Route::group(['middleware' => ['auth','ceklevel:admin']], function(){
    // admin
   

});