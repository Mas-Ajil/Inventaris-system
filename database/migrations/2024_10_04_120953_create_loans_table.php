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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kolom ID user peminjam (foreign key)
            $table->string('user_name'); 
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk yang dipinjam
            $table->integer('quantity'); // Jumlah barang yang dipinjam
            $table->date('borrowed_at'); // Tanggal pinjam
            $table->date('returned_at')->nullable(); // Tanggal kembali (optional)
            $table->text('notes')->nullable(); // Keterangan tambahan
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed'); // Status pinjaman
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
