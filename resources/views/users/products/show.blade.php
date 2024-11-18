@extends('layouts.pdf')

@section('container')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

    body {
        font-family: 'Poppins', sans-serif; /* Mengganti font menjadi Poppins */
        margin: 0;
        padding: 0;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40; /* Warna teks default */
    }

    .invoice-box {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        overflow: hidden;
        position: relative; /* Pastikan posisi relatif */
    }

    .header-flex {
        display: flex;
        flex-direction: column; /* Stack items vertically */
        justify-content: center; /* Center vertically */
        align-items: center; /* Center horizontally */
        position: relative;
        margin-bottom: 40px;
    }

    .header-flex h1 {
        font-size: 2rem; /* Ukuran font untuk judul */
        font-weight: 600;
        color: #20c997; /* Warna hijau */
        margin: 0; /* Menghapus margin default */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        text-align: center;
    }

    .total {
        background-color: #e9ecef; /* Light gray color for total row */
        font-weight: bold; /* Bold text for emphasis */
        text-align: right; /* Align text to the right */
    }

    table {
        width: 100%;
        border-collapse: collapse; /* Menghapus spasi antar sel */
        margin-top: 20px; /* Spasi atas untuk tabel */
    }

    th, td {
        padding: 15px; /* Spasi dalam sel */
        text-align: left; /* Rata kiri */
        border-bottom: 1px solid #dee2e6; /* Garis bawah untuk sel */
    }

    th {
        background-color: #f8f9fa; /* Latar belakang untuk header tabel */
        font-weight: 600;
        color: #343a40; /* Warna teks header */
    }

    td {
        font-size: 1rem;
        color: #6c757d; /* Warna teks sel */
    }

    .heading td {
        background-color: #20c997; /* Light green color */
        color: white; /* Change text color to white for contrast */
    }    

    tr:hover {
        background-color: #f1f1f1; /* Latar belakang saat hover */
    }

    .btn-back, .export-button {
        border: none;
        color: white;
        padding: 7px 15px;
        font-size: 1rem;
        border-radius: 5px;
        margin-top: 20px; /* Spasi atas */
        display: inline-block; /* Memastikan tombol sebagai blok inline */
        text-align: center;
        text-decoration: none; /* Menghapus garis bawah */
    }

    .btn-back {
        background: linear-gradient(45deg, #6c757d, #5a6268); /* Gradasi untuk tombol kembali */
    }

    .export-button {
        background: linear-gradient(45deg, #32CD32, #228B22);
    }

    .btn-back:hover {
        background: linear-gradient(45deg, #5a6268, #4e555b); /* Gradasi saat hover */
        transform: scale(1.05); 
        color: black;
    }

    .export-button:hover {
        background: linear-gradient(45deg, #228B22, #006400);  
        transform: scale(1.05); 
        color: black;
    }

    .rincian {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.8;
        }
    .label {
            display: inline-block;
            width: 200px; /* Adjust this to make the labels the same length */
            font-weight: bold;
        }
        @media print {
            /* Sembunyikan tombol cetak dan kembali saat dicetak */
            .no-print {
                display: none;
            }
            
            
        }
</style>

<body >
    <div class="invoice-box watermark">
        <div class="header-flex">
            <h1>Rincian</h1>
        </div>        
        <table>
            <tr class="information">
                <td colspan="2">
                    <div>
                        <span class="label">ID</span>
                        <span class="separator">: </span>
                        <span class="value">{{ $transaction->transaction_id }}</span>
                    </div>
                    <div>
                        <span class="label">Peminjam Barang</span>
                        <span class="separator">: </span>
                        <span class="value">{{ $loans->first()->user_name }}</span>
                    </div>
                    <div>
                        <span class="label">Pemberi Barang</span>
                        <span class="separator">: </span>
                        <span class="value">{{ $loans->first()->user->full_name }}</span>
                    </div>
                    <div>
                        <span class="label">Penerima Barang</span>
                        <span class="separator">: </span>
                        <span class="value">{{ $loans->first()->receiver }}</span>
                    </div>
                    <div>
                        <span class="label">Tanggal Peminjaman</span>
                        <span class="separator">: </span>
                        <span class="value">{{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->format('d F Y') }}
                    </div>
                    <div>
                        <span class="label">Estimasi Pengembalian</span>
                        <span class="separator">: </span>
                        <span class="value">{{ \Carbon\Carbon::parse($loans->first()->returned_at)->format('d F Y') }} ({{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->diffInDays(\Carbon\Carbon::parse($loans->first()->returned_at)) }} hari)</span>
                    </div>
                    <div>
                        <span class="label">Tanggal Dikembalikan</span>
                        <span class="separator">:</span>
                        <span class="value">
                            {{ $loans->first()->give_back ? \Carbon\Carbon::parse($loans->first()->give_back)->format('d F Y') : 'Dalam peminjaman' }}
                        </span>
                    </div>
                    
                    <div>
                        <span class="label">Keterangan</span>
                        <span class="seperator">: </span>
                        <span class="value">{{ $loans->first()->notes ?? 'Tidak ada keterangan' }}</span>
                    </div>

                    <div>
                        <span class="label">Kondisi</span>
                        <span class="seperator">: </span>
                        <span class="value">{{ $transaction->comment  }}</span>
                    </div>
            </tr>

            @if($loans->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">Tidak ada status saat.</td>
                </tr>
            @else
                <tr class="heading">
                    <td><strong>Barang</strong></td>
                    <td><strong>Jumlah</strong></td>
                </tr>
                @foreach($loans as $loan)
                    <tr class="item">
                        <td>{{ $loan->product->name }}</td>
                        <td>{{ $loan->quantity }}</td>
                        
                    </tr>
                @endforeach
                <tr class="total">
                    <td><strong>Total Barang</strong></td>
                    <td>{{ $loans->sum('quantity') }}</td>
                    
                </tr>
            @endif
        </table>
        <a href="{{ url()->previous() }}" class="btn-back no-print">Kembali</a>
        <a href="javascript:void(0)" onclick="window.print()" class="export-button no-print">
            <i class="bi bi-printer"></i> Cetak
        </a>
    </div>
</body>


@endsection
