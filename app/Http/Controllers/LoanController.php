<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('users.products', compact('products'));
    }

    public function store(Request $request)
{
    
    $validated = $request->validate([
        'user_name' => 'required|string|max:255',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:borrow_date',
        'notes' => 'nullable|string',
        'selected_products' => 'required|json',
    ]);

    // Decode string JSON dari produk yang dipilih
    $selectedProducts = json_decode($validated['selected_products'], true);

    // Validasi struktur produk yang dipilih
    if (!is_array($selectedProducts) || empty($selectedProducts)) {
        return redirect()->back()->withErrors(['selected_products' => 'Setidaknya satu produk harus dipilih.']);
    }

    
    $user_id = auth()->id(); 

    // Memulai transaksi database
    DB::beginTransaction();

    try {
        // Loop untuk menyimpan semua produk yang dipilih
        foreach ($selectedProducts as $productId => $productData) {
            // Validasi keberadaan produk dan jumlah
            $product = Product::findOrFail($productId);
            if ($product->stock < $productData['count']) {
                throw new \Exception("Stok tidak mencukupi untuk produk: {$product->name}");
            }

           
            $loan = new Loan();
            $loan->user_id = $user_id;
            $loan->user_name = $validated['user_name'];
            $loan->borrowed_at = $validated['borrow_date'];
            $loan->returned_at = $validated['return_date'];
            $loan->notes = $validated['notes'];
            $loan->product_id = $productId;
            $loan->quantity = $productData['count'];
            $loan->save();

            
            $product->stock -= $productData['count'];
            $product->save();
        }

        // Jika semuanya berhasil, komit transaksi
        DB::commit();

        return redirect()->back()->with('success', 'Pinjaman berhasil dibuat!');
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        DB::rollBack();

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}




        public function userLoans()
    {
        $loans = Loan::with(['user', 'product'])->get();

        return view('users.status', compact('loans'));
    }

    public function history()
    {
        
        $loans = loan::where('status', 'returned')->with('product')->get();

        return view('users.history', compact('loans'));
    }


    public function showLoans($userName)
{
    $loans = Loan::where('user_name', $userName)
        ->where('status', 'borrowed')
        ->with('product')
        ->get();

    return view('users.products.show', compact('loans', 'userName'));
}

public function return($userName)
{
    // Temukan semua pinjaman berdasarkan user_name
    $loans = Loan::where('user_name', $userName)
                 ->where('status', 'borrowed') // Pastikan hanya mengubah status yang masih borrowed
                 ->get();

    foreach ($loans as $loan) {
        // Perbarui status menjadi 'returned'
        $loan->status = 'returned';
        $loan->returned_at = now(); // Tambahkan tanggal pengembalian
        $loan->save();
    }

    return redirect()->back()->with('success', 'Equipment has been successfully returned.');
}

public function showDetails($userName, $borrowedAt)
{
    // Ambil pinjaman berdasarkan user_name dan borrowed_at
    $loanDetails = Loan::where('user_name', $userName)
                        ->where('borrowed_at', $borrowedAt)
                        ->first();

    if (!$loanDetails) {
        return redirect()->back()->with('error', 'Loan details not found.');
    }
    
    return view('users.products.showReturned', compact('loanDetails'));
}

    
}



        