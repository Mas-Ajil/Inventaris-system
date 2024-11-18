<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Loan;
use App\Models\transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\LoansExport;
use PDF; 
use Maatwebsite\Excel\Facades\Excel;

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
    $transactionId = Transaction::generateTransactionId();

    // Memulai transaksi database
    DB::beginTransaction();

    try {
        $transaction = Transaction::create([
            'user_id' => $user_id,
            'transaction_id' => $transactionId,
        ]);
        // Loop untuk menyimpan semua produk yang dipilih
        foreach ($selectedProducts as $productId => $productData) {
            // Validasi keberadaan produk dan jumlah
            $product = Product::findOrFail($productId);
            if ($product->stock < $productData['count']) {
                throw new \Exception("Stok tidak mencukupi untuk produk: {$product->name}");
            }

           
            $loan = new Loan();
            $loan->user_id = $user_id;
            $loan->transaction_id = $transaction->id;
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

        return redirect()->route('status.loans');
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        DB::rollBack();

        return redirect()->back();
    }
}




        public function userLoans()
    {
        $transactions = Transaction::with('loans', 'user')
            ->where('status', 'borrowed')
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('users.status', compact('transactions'));
    }

   


    public function showLoans( Transaction $transaction)
{

    $loans = $transaction
            ->loans()
            ->with('product')
            
            ->get(); 


    return view('users.products.show', compact('loans', 'transaction'));
}

public function return(Request $request, $transaction_id)
{
   
    $transaction = Transaction::with('loans')->findOrFail($transaction_id);

    $request->validate([
        'comment' => 'nullable|string|max:255', // Keterangan bisa diisi atau kosong
    ]);
    
    $receiver = auth()->user()->full_name;

   
    if ($transaction->status === 'borrowed') {
        foreach ($transaction->loans as $loan) {
            
           
            $product = Product::find($loan->product_id); 
            if ($product) {
                $product->stock += $loan->quantity; 
                $product->save(); 
            }

           
            $loan->receiver = $receiver;
            $loan->give_back = now(); 
            $loan->save();
        }

       
        $transaction->status = 'returned';
        $transaction->comment = $request->input('comment');
        $transaction->save(); 
    }

    return redirect( )->route('loans.history')->with('success', 'Equipment has been successfully returned.');
}


public function history()
{
    
    $transactions = Transaction::with('loans', 'user')
        ->where('status', 'Returned')
        ->orderBy('created_at', 'desc') 
        ->get();
    

    return view('users.history', compact('transactions'));
}



public function export() 
    {
        return Excel::download(new LoansExport, 'loans-history.xlsx');
    }



    
    
    

}



        