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
        
        $request->validate([
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:0', 
            'borrowed_at' => 'required|date',
            'returned_at' => 'required|date|after_or_equal:borrowed_at',
        ]);

        
        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];

            
            if ($quantity > 0) {
               
                $product = Product::find($productId);

               
                if ($product->stock >= $quantity) {
                    
                    Loan::create([
                        'product_id' => $productId,
                        'user_id' => Auth::id(),
                        'quantity' => $quantity,
                        'borrowed_at' => $request->borrowed_at,
                        'returned_at' => $request->returned_at,
                    ]);

                    
                    $product->reduceStock($quantity);
                } else {
                    
                    return redirect()->back()->withErrors(["Stok produk {$product->name} tidak cukup."]);
                }
            }
        }

        return redirect()->route('loans.user')->with('success', 'Peminjaman berhasil!');
    }

        public function userLoans()
    {
        $loans = Auth::user()->loans()->where('status', 'borrowed')->with('product')->get();

        return view('users.pengembalian', compact('loans'));
    }

    public function history()
    {
        
        $loans = Auth::user()->loans()->where('status', 'returned')->with('product')->get();

        return view('users.history', compact('loans'));
    }
}

