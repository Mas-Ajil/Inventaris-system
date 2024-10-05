<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relasi ke product
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->integer('quantity')->default(1); // Jumlah item yang dipinjam
            $table->date('borrowed_at'); // Tanggal pinjam
            $table->date('returned_at'); // Tanggal kembali
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
