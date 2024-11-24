<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Mengambil data produk dan mengonversinya ke dalam array
     */
    public function array(): array
    {
        $data = Product::select('name', 'stock')->get()->map(function ($product) {
            return [
                $product->name,
                $product->stock,
            ];
        });
        
        // Gabungkan heading ke array data
        return array_merge([$this->headings()], $data->toArray());
    }

    /**
     * Mendefinisikan heading untuk kolom di Excel
     */
    public function headings(): array
    {
        return [
            'Nama Produk',
            'Stok'
        ];
    }

    /**
     * Menetapkan judul pada sheet
     */
    public function title(): string
    {
        return 'Laporan Produk';
    }

    /**
     * Mendefinisikan style untuk sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Judul
        $sheet->setCellValue('A1', 'Laporan Data Produk');
        $sheet->mergeCells('A1:B1'); // Gabungkan cell untuk judul

        return [
            1 => ['alignment' => ['horizontal' => 'center'], 'font' => ['bold' => true, 'size' => 16]], // Style judul
            2 => ['alignment' => ['horizontal' => 'center'], 'font' => ['bold' => true, 'size' => 12], 'background' => ['argb' => 'FFC080']], // Style heading
            'B' => ['alignment' => ['horizontal' => 'center']], // Pusatkan kolom stok
        ];
    }

    /**
     * Menetapkan lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 50, // Nama Produk
            'B' => 15, // Stok
        ];
    }
}
