<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function showHomeAdmin()
    {
        $user = Auth::user(); // Mengambil user yang sedang login


        return view('admin.profile', compact('user'));
        
    }

    public function updateProfile(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        'phone' => 'required|string|max:15',
        'address' =>  'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed', // Password tidak wajib diisi
    ]);

    // Update data profil
    $user->name = $request->name;
    $user->full_name = $request->full_name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Simpan perubahan
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}






    
    public function listUser()
    {
        $users = User::all();
        return view('admin.listUser', compact('users'));
        
    }

    public function addUser(Request $request)
{
   $validate = $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'password' => 'required|min:5|max:255'
        ]);
    
        User::create($validate);

    return redirect()->route('admin.listUser')->with('success', 'User added successfully!');
}

public function updateUser(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:8',
        'level' => 'nullable'
    ]);

    $user = User::findOrFail($id);

    // Flags to check if name or password was updated
    $nameUpdated = false;
    $passwordUpdated = false;
    $levelUpdated = false;

    // Update name if it has changed
    if ($user->name !== $validatedData['name']) {
        $user->name = $validatedData['name'];
        $nameUpdated = true;
    }

    // Update password if it's provided
    if (!empty($validatedData['password'])) {
        $user->password = bcrypt($validatedData['password']);
        $passwordUpdated = true;
    }

    if (!empty($validatedData['level'])) {
        $user->level= $validatedData['level'];
        $levelUpdated = true;
    }
    
    
    $user->save();

    // Log activity based on updates
    activity('update')
        ->causedBy(auth()->user())
        ->performedOn($user)
        ->withProperties([
            'name' => $user->name,
        ])
        ->log(
            $nameUpdated && $passwordUpdated
                ? 'Name and password updated'
                : ($nameUpdated ? 'Name updated' : 'Password updated')
        );

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
    activity()
        ->causedBy(auth()->user())
        ->withProperties([
            'product_name' => $validatedData['name'],
            'stock' => $validatedData['stock']
        ])
        ->log('Added a product');
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil ditambahkan');
}

public function updateproducts(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'stock' => 'required|integer',
    ]);

    $product = Product::findOrFail($id);
    $productName = $product->name;
    $productStock = $product->stock;
    $product->update($validatedData);

    activity('Update')
        ->causedBy(auth()->user())
        ->withProperties(['product_name' => $productName, 'product_stock' => $productStock])
        ->log('Product Updated');
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil diupdate');
}


public function destroyProduct($id){
    $product = Product::find($id);
    $productName = $product->name;
    $product->delete();

    activity('delete')
        ->causedBy(auth()->user())
        ->withProperties(['product_name' => $productName])
        ->log('Product deleted');
    return redirect('/listProduct')->with('success', 'Products deleted successfully');
}

public function bulkDelete(Request $request)
{
    Product::whereIn('id', $request->input('selected_products'))->delete();
    return redirect()->back()->with('success', 'Produk terpilih telah dihapus.');
}

public function importProduct(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new ProductsImport, $request->file('file'));

    return redirect()->back();
}

public function exportProduct() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }


}

