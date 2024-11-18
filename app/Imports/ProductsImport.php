<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, WithStartRow
{
    /**
     * Tentukan baris awal import
     */
    public function startRow(): int
    {
        return 3;
    }

    /**
     * Map data dari setiap baris ke model
     */
    public function model(array $row)
    {

        $existingProduct = Product::where('name', $row[0])->first();

        // Jika produk sudah ada, abaikan dan jangan buat entri baru
        if ($existingProduct) {
            return null;
        }
        
        return new Product([
            'name' => $row[0],
            'stock' => $row[1],
        ]);
    }
}
