@extends('layouts.main')

@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
    }

    .container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        text-align: center;  /* Centering the h1 */
        margin-bottom: 40px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .more-button {
        background: linear-gradient(45deg, #ff7e5f, #feb47b); 
        border: none;
        color: white;
        padding: 5px 10px; 
        font-size: 1rem; 
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s;
        text-decoration: none; 
        text-align: center; 
    }

    .more-button:hover {
        background: linear-gradient(45deg, #ff6b4d, #fea16e); 
        transform: scale(1.05); 
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: center;
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

    .table {
        margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        table, th, td {
            font-size: 0.9rem;
        }

        h1 {
            flex-direction: column; 
            align-items: flex-start; 
        }

        .return-button {
            margin-top: 10px; 
        }
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Peminjaman</h1>
        <a href="{{ route('loans.export') }}" class="btn btn-primary">Export to Excel</a>

        @if($transactions->isEmpty())
            <p>You haven't borrowed any equipment yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Pemberi</th>
                        <th>Penerima</th>
                        <th>Tanggal Pinjam</th>
                        <th>Estimasi Kembali</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction) 
                        @php
                            // Mengambil data pinjaman pertama untuk ditampilkan
                            $firstLoan = $transaction->loans->first(); 
                        @endphp
                        <tr>
                            <td>{{ $firstLoan->user_name }}</td> 
                            <td>{{ $transaction->user->name }}</td> 
                            <td>{{ $firstLoan->receiver }}</td> 
                            <td>{{ \Carbon\Carbon::parse($firstLoan->borrowed_at)->format('d-m-Y') }}</td>
                            <td>{{ $firstLoan->returned_at ? \Carbon\Carbon::parse($firstLoan->returned_at)->format('d-m-Y') : 'Belum Kembali' }}</td>
                            <td>
                                <a href="{{ route('loan.show', $transaction->id) }}" class="more-button">More</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</body>
</html>
@endsection
