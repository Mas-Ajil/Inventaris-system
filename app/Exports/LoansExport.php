<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoansExport implements FromArray, WithHeadings
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
                            $loan->user->name,
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
}
