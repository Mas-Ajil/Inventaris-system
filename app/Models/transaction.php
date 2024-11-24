<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class transaction extends Model
{
    use HasFactory;
    protected $fillable = ['status' , 'transaction_id','user_id', 'comment']; 

    protected $table = 'transactions'; // Sesuaikan dengan nama tabel Anda

    // Fungsi untuk menghasilkan ID transaksi unik
    public static function generateTransactionId()
    {
        $date = date('Ymd'); // Format tanggal YYYYMMDD
        $prefix = 'TNS-' . $date;

        // Ambil ID terakhir yang memiliki prefix yang sama
        $lastId = DB::table('transactions')
            ->where('transaction_id', 'like', $prefix . '%')
            ->orderBy('transaction_id', 'desc')
            ->first();

        // Jika tidak ada transaksi sebelumnya, mulai dari 1000
        if (!$lastId) {
            return $prefix . '-1000';
        }

        // Ekstrak nomor terakhir
        $lastTransactionNumber = (int)substr($lastId->transaction_id, -4);
        $newTransactionNumber = $lastTransactionNumber + 1;

        return $prefix . '-' . str_pad($newTransactionNumber, 4, '0', STR_PAD_LEFT);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function product()
{
    return $this->hasMany(Product::class); 
}
}
