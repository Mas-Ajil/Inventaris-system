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

.container {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.header-flex {
    display: flex;
    justify-content: center; /* Ensures the h1 is centered */
    align-items: center; /* Vertically aligns the button and h1 */
    position: relative;
    margin-bottom: 40px;
}

.header-flex h1 {
    font-size: 2.5rem;
    font-weight: 600;
    color: #20c997; 
    margin: 0; /* Remove default margin */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.export-button {
    position: absolute; /* Make sure the button is absolute */
    right: 0; /* Aligns the button to the far right */
    top: 19%;
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

.export-button:hover {
    background: linear-gradient(45deg, #0056b3, #00aaff);  
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

.search-container {
    display: flex;
    align-items: center; /* Align vertically center */
}

.input-group {
    width: 300px; /* Adjust width of the input group */
}

.form-control {
    width: 100%; /* Fill the input group */
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 20px;
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    .header-flex {
        flex-direction: column; /* Stack h1 and button on small screens */
        align-items: flex-start;
    }

    .export-button {
        position: relative;
        margin-top: 10px;
        transform: none; /* Disable transform when stacked */
    }

    table, th, td {
        font-size: 0.9rem; /* Adjust font size for smaller screens */
    }

    /* You may want to add other styles specific to mobile view here */
}

  </style>

    <div class="">
        <div class="header-flex">
            <h1>Riwayat Peminjaman</h1>
            <a href="{{ route('loans.export') }}" class="export-button">
                <i class="bi bi-archive" style="margin-right: 5px;"></i>
                Export to Excel
            </a>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text" id="search-addon">
                    <i class="bi-search"></i>
                </span>
                <input type="text" id="search" onkeyup="searchTransaction()" class="form-control" placeholder="Cari riwayat peminjaman..." aria-describedby="search-addon">
            </div>
        </div>
       
        
        @if($transactions->isEmpty())
            <p>Belum ada riwayat peminjaman sama sekali.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Pemberi</th>
                        <th>Penerima</th>
                        <th>Tanggal Pinjam</th>
                        <th>Estimasi Kembali</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $index => $transaction) 
                        @php
                            $firstLoan = $transaction->loans->first(); 
                            $totalTransactions = $transactions->count();
                        @endphp
                        <tr class="transaction-item"> <!-- Add class here -->
                            <td>{{ $totalTransactions - $loop->index }}</td> 
                            <td>{{ $firstLoan->user_name }}</td> 
                            <td>{{ $transaction->user->full_name }}</td> 
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
    <script>
        function searchTransaction() {
            const input = document.getElementById('search').value.toLowerCase();
            const transactions = document.querySelectorAll('.transaction-item');

            transactions.forEach(item => {
                const cells = item.getElementsByTagName('td');
                let found = false;

                // Check if any cell in the row matches the search input
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }

                item.style.display = found ? '' : 'none'; // Show or hide the row based on the search
            });
        }
    </script>

@endsection
