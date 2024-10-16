@extends('layouts.main')

@section('container')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white for better blending */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        text-align: center; 
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #343a40;
    }

    td {
        font-size: 1rem;
        color: #6c757d;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Tabel Detail Peminjaman */
    .table:first-of-type {
        margin-bottom: 30px;
    }

    /* Tabel Daftar Produk */
    .table:nth-of-type(2) {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        overflow: hidden;
    }

    .table:nth-of-type(2) th {
        background-color: #20c997; /* Warna header tabel produk */
        color: white;
    }

    .table:nth-of-type(2) td {
        background-color: #ffffff; /* Warna latar belakang sel tabel */
    }

    .table:nth-of-type(2) tr:nth-child(even) td {
        background-color: #f8f9fa; /* Warna latar belakang baris genap */
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 10px 15px;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Warna hover */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 2rem; /* Mengurangi ukuran font di perangkat kecil */
        }

        th, td {
            padding: 10px; /* Mengurangi padding di perangkat kecil */
        }
    }
</style>

<div class="container">
    <h1>Detail Peminjaman</h1>

    <table class="table">
        <tr>
            <th>Peminjam</th>
            <td>{{ $loans->first()->user_name }}</td>
        </tr>
        <tr>
            <th>Pemberi</th>
            <td>{{ $loans->first()->user->name }}</td>
        </tr>
        <tr>
            <th>Penerima</th>
            <td>{{ $loans->first()->receiver }}</td>
        </tr>
        <tr>
            <th>Tanggal pinjam</th>
            <td>{{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Estimasi Kembali</th>
            <td>
                @if($loans->first()->returned_at)
                    {{ \Carbon\Carbon::parse($loans->first()->returned_at)->format('d-m-Y') }} ({{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->diffInDays(\Carbon\Carbon::parse($loans->first()->returned_at)) }} hari)
                @else
                    Not returned
                @endif
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $loans->first()->transaction->status }}</td>
        </tr>
        <tr>
            <th>Dikembalikan</th>
            <td>
                @if($loans->first()->give_back)
                    {{ \Carbon\Carbon::parse($loans->first()->give_back)->format('d-m-Y') }}
                @else
                    Belum Kembali
                @endif
            </td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $loans->first()->notes ?? 'Tidak ada keterangan' }}</td>
        </tr>
    </table>

    @if($loans->isEmpty())
        <p>Tidak ada status saat.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->product->name }}</td> 
                        <td>{{ $loan->quantity }}</td> 
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Quantity</th>
                    <th>{{ $loans->sum('quantity') }}</th> 
                </tr>
            </tfoot>
        </table>
    @endif
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
</div>

@endsection
