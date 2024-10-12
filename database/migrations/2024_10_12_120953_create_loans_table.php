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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key untuk user
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->onDelete('cascade'); // Pastikan tabel transactions dan tipe data sesuai
            $table->string('user_name'); 
            $table->string('receiver')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key untuk produk
            $table->integer('quantity'); 
            $table->date('borrowed_at'); 
            $table->date('returned_at')->nullable(); 
            $table->text('notes')->nullable(); 
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
