<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'stock',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    
    // Metode untuk mengurangi stok produk
    public function reduceStock($quantity)
    {
        // Mengurangi stok produk dengan jumlah yang dipinjam
        $this->stock -= $quantity;
        $this->save(); // Simpan perubahan ke database
    }
}
