<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\transaction;
use Carbon\Carbon;
use App\Models\user;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function showHome(Request $request)
    {
        $totalUsers = User::where('level', 'admin')
                    ->count();  
        $totalPeminjamBulanIni = Transaction::whereMonth('created_at', date('m'))
                                             ->whereYear('created_at', date('Y'))
                                             ->count();
        $totalBorrowed = Transaction::where('status', 'borrowed')->count();
        $totalReturned = Transaction::where('status', 'returned')->count();




        $year = $request->input('year', date('Y'));

        // Ambil data transaksi dengan status 'returned' dalam tahun ini
        $returnedTransactions = Transaction::where('status', 'returned')
            ->whereYear('created_at', $year) // Menggunakan created_at dari tabel transactions
            ->get();


        // Inisialisasi array untuk bulan-bulan dalam satu tahun (Jan - Dec)
        $monthlyTransactions = collect([
            'January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 
            'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0,
            'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0
        ]);

        // Kelompokkan transaksi berdasarkan bulan dan hitung jumlahnya
        $groupedReturned = $returnedTransactions->groupBy(function($date) {
            return Carbon::parse($date->returned_at)->format('F'); // Nama bulan
        })->map(function($row) {
            return $row->count();
        });

      

        // Gabungkan dengan array bulan (mengisi bulan yang tidak ada transaksi dengan 0)
        foreach ($groupedReturned as $month => $count) {
            $monthlyTransactions[$month] = $count;
        }

        

       
        return view('users.home', compact('totalUsers', 'totalPeminjamBulanIni', 'totalBorrowed', 'totalReturned','monthlyTransactions', 'year'));
    }
}
