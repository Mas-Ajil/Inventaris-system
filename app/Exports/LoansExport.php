<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoansExport implements FromArray, WithHeadings , WithStyles,  WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        
        $data = Loan::with('product')->get()->map(function ($loan) {
                        return [
                            $loan->user_name,
                            $loan->product->name, 
                            $loan->quantity,
                            $loan->user->full_name,
                            $loan->receiver,
                            $loan->borrowed_at,
                            $loan->returned_at,
                            $loan->give_back,
                            $loan->transaction->status,
                        ];
                    });
                    return array_merge([$this->headings()], $data->toArray());
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Produk',
            'Quantity',
            'Pemberi',
            'Penerima',
            'Tanggal Pinjam',
            'Estimasi Kembali',
            'Tanggal Dikembalikan',
            'status',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        
    
    
    $sheet->setCellValue('A1', 'Laporan Data Peminjaman Produk');
    
    // Gabungkan cell untuk judul
    $sheet->mergeCells('A1:I1');
    

        return [
            // Styling untuk header
            1    => ['alignment' => ['horizontal' => 'center'], 'font' => ['bold' => true, 'size' => 16]],
            // Judul ditempatkan di baris pertama, dan kolom dari A sampai G
            2    => ['alignment' => ['horizontal' => 'center'], 'font' => ['bold' => true, 'size' => 14], 'background' =>  ['argb' => 'FFC080']],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,   
            'B' => 50,  
            'C' => 12,  
            'D' => 25,  
            'E' => 25,  
            'F' => 20, 
            'G' => 20,
            'H' => 25,
            'I' =>  15,
        ];
    }
}
