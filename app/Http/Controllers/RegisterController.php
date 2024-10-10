<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index',[
            'title' => 'Register'
           ] );
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);
    
        User::create($validate);
        
        return redirect('/login')->with('success', 'Registrasi berhasil!');
}
}
