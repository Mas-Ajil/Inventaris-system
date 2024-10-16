<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\user;

class AdminController extends Controller
{
    
    public function listUser()
    {
        $users = User::all();
        return view('admin.listUser', compact('users'));
        
    }

    public function addUser(Request $request)
{
   $validate = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);
    
        User::create($validate);

    return redirect()->route('admin.listUser')->with('success', 'User added successfully!');
}

    public function updateUser(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:5',  
    ]);
    $user = User::findOrFail($id);
    $user->name = $request->name;
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);  
    }
    $user->save();
    return redirect()->route('admin.listUser')->with('success', 'User updated successfully!');
}

public function destroyUser($id){
    $user = user::find($id);
    $user->delete();

    return redirect('/listUser')->with('success', 'User deleted successfully');
}













public function listProducts()
{
    $products = Product::all();
    return view('admin.listProducts', compact('products'));
}

public function addProducts(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'stock' => 'required|integer',
    ]);

    Product::create($validatedData);
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil ditambahkan');
}

public function updateproducts(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'stock' => 'required|integer',
    ]);

    $product = Product::findOrFail($id);
    $product->update($validatedData);
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil diupdate');
}


public function destroyProduct($id){
    $product = Product::find($id);
    $product->delete();

    return redirect('/listProduct')->with('success', 'Products deleted successfully');
}
}
