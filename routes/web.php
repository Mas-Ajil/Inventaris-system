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
    // dasboard user
   
    Route::get('/loans', [LoanController::class, 'index'])->name('loans')->middleware('auth');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store')->middleware('auth');

    Route::get('/my-loans', [LoanController::class, 'userLoans'])->name('loans.user')->middleware('auth');
    
});