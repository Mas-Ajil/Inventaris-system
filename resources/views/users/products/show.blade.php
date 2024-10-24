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
        width: 100%; /* Memastikan lebar 100% untuk responsif */
        max-width: 800px; /* Lebar maksimum untuk nota */
        margin: 20px auto; /* Margin otomatis untuk center */
        padding: 30px;
        border-radius: 15px; /* Sudut membulat */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        background-color: #ffffff; /* Latar belakang putih untuk nota */
        overflow: hidden; /* Mencegah konten keluar dari container */
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
        background: linear-gradient(45deg, #007bff, #00c6ff);
    }

    .btn-back:hover {
        background: linear-gradient(45deg, #5a6268, #4e555b); /* Gradasi saat hover */
        transform: scale(1.05); 
    }

    .export-button:hover {
        background: linear-gradient(45deg, #0056b3, #00aaff);  
        transform: scale(1.05); 
    }
</style>
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header-flex">
            <h1>Rincian</h1>
        </div>        
        <table>
            <tr class="information">
                <td colspan="2">
                    <strong>Peminjam :</strong> {{ $loans->first()->user_name }}<br/>
                    <strong>Pemberi :</strong> {{ $loans->first()->user->full_name }}<br/>
                    <strong>Penerima :</strong> {{ $loans->first()->receiver }}<br/>
                    <strong>Tanggal Pinjam :</strong> {{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->format('d-m-Y') }}<br/>
                    <strong>Estimasi Kembali :</strong> 
                    @if($loans->first()->returned_at)
                        {{ \Carbon\Carbon::parse($loans->first()->returned_at)->format('d-m-Y') }} 
                        ({{ \Carbon\Carbon::parse($loans->first()->borrowed_at)->diffInDays(\Carbon\Carbon::parse($loans->first()->returned_at)) }} hari)
                    @else
                        Belum Kembali
                    @endif
                    <br/>
                    <strong>Status :</strong> {{ $loans->first()->transaction->status }}<br/>
                    <strong>Dikembalikan :</strong> 
                    @if($loans->first()->give_back)
                        {{ \Carbon\Carbon::parse($loans->first()->give_back)->format('d-m-Y') }}
                    @else
                        Belum Kembali
                    @endif
                    <br/>
                    <strong>Keterangan :</strong> {{ $loans->first()->notes ?? 'Tidak ada keterangan' }}
                </td>
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
        <a href="{{ url()->previous() }}" class="btn-back">Kembali</a>
        <a href="{{ route('loan.download', $transaction->id) }}" class="export-button">
            <i class="bi bi-printer"></i> Cetak
        </a>
    </div>
</body>
</html>

@endsection
