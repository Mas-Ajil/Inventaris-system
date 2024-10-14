<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'transaction_id',
        'user_name', 
        'receiver',
        'product_id', 
        'quantity', 
        'borrowed_at',
        'returned_at', 
        'give_back',
        'notes', 
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function products()
{
    return $this->hasMany(Product::class, 'loan_id'); 
}
}
