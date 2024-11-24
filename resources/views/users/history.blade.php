@extends('layouts.main')

@section('container')

<style>
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: url('/assets/bg-all.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #343a40;
}

    #search-box {
        display: flex;
        transition: all 0.3s ease;
    }

    #search {
        width: 170px;
        min-width: 200px;
        border-radius: 5px;
    }

    .active-button {
        background: linear-gradient(45deg, #007bff, #00c6ff); 
        color: white;
    }

    .container-products {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin: 20px;
        overflow-x: auto;

    }

    .header-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin-bottom: 40px;
    }

    .header-flex h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .export-button {
        background: linear-gradient(45deg, #32CD32, #228B22);
        border: none;
        color: #fff;
        padding: 6px 14px;
        font-size: 1rem; 
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s;
        text-decoration: none;
        text-align: center;
        
    }

    .export-button:hover {
        background: linear-gradient(45deg, #228B22, #006400); 
        transform: scale(1.05); 
        color: black;
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

    .more-button {
        background: linear-gradient(45deg, #007bff, #00c6ff); 
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
        background: linear-gradient(45deg, #0056b3, #00aaff); 
        transform: scale(1.05); 
        color: black;
    }

    .search-container {
        display: flex;
        align-items: center;
    }

    .input-group {
        width: 200px;
    }

    .input-group .form-control {
        height: 30px;
        padding: 0.375rem 0.75rem;
    } 


    .pagination-button {
        background-color: white;
        color: #007bff;
        border: 1px solid #007bff;
        transition: background 0.3s ease, color 0.3s ease;
        margin: 0 5px; 
        padding: 0.5rem 1rem;
    }

    .pagination-button:hover {
        background-color: #007bff;
        color: white;
    }

    .pagination-button.active {
        background-color: #007bff;
        color: white; 
        border: 1px solid #007bff; 
        cursor: default;
    }

    
    /* Responsive */
    @media (max-width: 768px) {

        .header-flex {
            flex-direction: column;
            align-items: flex-start;
        }

        table, th, td {
            font-size: 0.9rem;
        }
        
        .export-text {
            display: none;
        }

        .export-button {
            padding-left: 8px;
            padding-top: 8px;
            padding-bottom: 8px;
            padding-right: 8px;
            margin-left: 5px;
        }
        
        
    }
</style>

<div class="container-products">
    <div class="header-flex">
        <h1>Riwayat Peminjaman</h1>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary" id="toggle-search" onclick="toggleSearchBox()">
                <i class="bi bi-search"></i>
            </button>
       
            <!-- Hidden Search Box -->
            <div id="search-box" class="input-group ms-2" style="display: none; max-width: 200px;">
                <input type="text" id="search" class="form-control" onkeyup="searchTransaction()" placeholder="Cari barang...">
            </div>
        </div>
        
        
            <a href="{{ route('loans.export') }}" class="export-button">
                    <i class="fa fa-download"></i>
                    
            </a>   
    </div>
   
    @if($transactions->isEmpty())
        <p>Belum ada riwayat peminjaman sama sekali.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Peminjam Barang</th>
                    <th>Pemberi Barang</th>
                    <th>Penerima Barang</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction) 
                    @php
                        $firstLoan = $transaction->loans->first(); 
                    @endphp
                    <tr class="transaction-item">
                        <td>{{ $transaction->transaction_id }}</td> 
                        <td >{{ $firstLoan->user_name }}</td> 
                        <td>{{ $transaction->user->full_name }}</td> 
                        <td>{{ $firstLoan->receiver }}</td> 
                        <td>{{ \Carbon\Carbon::parse($firstLoan->borrowed_at)->format('d-m-Y') }}</td>
                        <td>{{ $firstLoan->give_back ? \Carbon\Carbon::parse($firstLoan->give_back)->format('d-m-Y') : 'Belum Kembali' }}</td>
                        <td>
                            <a href="{{ route('loan.show', $transaction->id) }}" class="more-button">Rincian</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>                
        </table>
        <div>
            
            <div id="paginationControls" class="d-flex justify-content-end mt-4"></div>
        </div>
    @endif
    

<script src="/js/history.js">

</script>
@endsection
