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

    activity('Update')
        ->causedBy(auth()->user())
        ->withProperties(['update profile or password'])
        ->log('Profile Updated');

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
    
    activity('Create')
        ->causedBy(auth()->user())
        ->withProperties(['Name' => $request->name])
        ->log('Add User');    

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
    activity('Update')
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

    activity('Delete')
        ->causedBy(auth()->user())
        ->withProperties(['Name' => $user->name])
        ->log('Delete User');    

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
    activity('Add')
        ->causedBy(auth()->user())
        ->withProperties([
            'product_name' => $validatedData['name'],
            'stock' => $validatedData['stock']
        ])
        ->log('Added a product');
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil ditambahkan');
}

public function updateProducts(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'stock' => 'required|integer',
    ]);

    // Ambil data produk sebelum diupdate
    $product = Product::findOrFail($id);
    $oldProperties = [
        'name' => $product->name,
        'stock' => $product->stock,
    ];

    // Update produk
    $product->update($validatedData);

    // Ambil data produk setelah diupdate
    $newProperties = [
        'name' => $product->name,
        'stock' => $product->stock,
    ];

    // Log aktivitas
    activity('Update')
        ->causedBy(auth()->user())
        ->performedOn($product)
        ->withProperties([
            'before' => $oldProperties,
            'after' => $newProperties,
        ])
        ->log('Product updated');

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.listProducts')->with('success', 'Product berhasil diupdate');
}



public function destroyProduct($id){
    $product = Product::find($id);
    $productName = $product->name;
    $product->delete();

    activity('Delete')
        ->causedBy(auth()->user())
        ->withProperties(['product_name' => $productName])
        ->log('Product Deleted');
    return redirect('/listProduct')->with('success', 'Products deleted successfully');
}

public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');
    
    if ($ids) {
        // Ambil nama produk berdasarkan ID
        $products = Product::whereIn('id', $ids)->get(['name']);
        
        // Hapus produk
        Product::whereIn('id', $ids)->delete();

        // Buat daftar nama produk
        $productNames = $products->pluck('name')->toArray();

        // Catat aktivitas ke dalam log
        activity('Delete')
            ->causedBy(auth()->user())
            ->withProperties(['product_names' => $productNames])
            ->log('Products Deleted');

        // Berikan respons JSON dengan nama produk yang dihapus
        return response()->json([
            'success' => true,
            'deleted_products' => $productNames,
        ]);
    }

    return response()->json(['success' => false, 'message' => 'No products selected'], 400);
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
        activity('Export')
            ->causedBy(auth()->user())
            ->withProperties(['Export to Excel'])
            ->log('Products Export');

        return Excel::download(new ProductsExport, 'products.xlsx');
    }


}

