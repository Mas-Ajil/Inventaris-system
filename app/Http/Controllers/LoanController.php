<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class loanController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('users.peminjaman', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:0', // Allow 0, but will filter it out later
            'borrowed_at' => 'required|date',
            'returned_at' => 'required|date|after_or_equal:borrowed_at',
        ]);

        // Loop untuk setiap produk yang dipilih
        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];

            // Hanya lanjutkan jika quantity lebih dari 0
            if ($quantity > 0) {
                // Ambil produk dari database
                $product = Product::find($productId);

                // Pastikan stok cukup
                if ($product->stock >= $quantity) {
                    // Buat entri peminjaman
                    Loan::create([
                        'product_id' => $productId,
                        'user_id' => Auth::id(),
                        'quantity' => $quantity,
                        'borrowed_at' => $request->borrowed_at,
                        'returned_at' => $request->returned_at,
                    ]);

                    // Kurangi stok produk
                    $product->reduceStock($quantity);
                } else {
                    // Jika stok tidak cukup, bisa memberikan pesan error
                    return redirect()->back()->withErrors(["Stok produk {$product->name} tidak cukup."]);
                }
            }
        }

        return redirect()->route('loans.user')->with('success', 'Peminjaman berhasil!');
    }

    public function userLoans()
{
    // Mengambil semua peminjaman user yang sedang login, termasuk detail produk
    $loans = Auth::user()->loans()->with('product')->get();

    return view('users.pengembalian', compact('loans'));
}
}

