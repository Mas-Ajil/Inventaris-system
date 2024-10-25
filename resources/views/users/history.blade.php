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
    bottom: 6%; /* Aligns the button to the far right */
    background: linear-gradient(45deg, #32CD32, #228B22);
    border: none;
    color: rgb(255, 255, 255);
    padding: 5px 10px; 
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
        transform: none;
        
        /* Disable transform when stacked */
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
        
    </div>
    
    <div class=" mb-3">
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
                    <th>Peminjam</th>
                    <th>Pemberi</th>
                    <th>Penerima</th>
                    <th>Tanggal Pinjam</th>
                    <th>Estimasi Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction) 
                    @php
                        $firstLoan = $transaction->loans->first(); 
                    @endphp
                    <tr class="transaction-item">
                        <td >{{ $firstLoan->user_name }}</td> 
                        <td>{{ $transaction->user->full_name }}</td> 
                        <td>{{ $firstLoan->receiver }}</td> 
                        <td>{{ \Carbon\Carbon::parse($firstLoan->borrowed_at)->format('d-m-Y') }}</td>
                        <td>{{ $firstLoan->returned_at ? \Carbon\Carbon::parse($firstLoan->returned_at)->format('d-m-Y') : 'Belum Kembali' }}</td>
                        <td>
                            <a href="{{ route('loan.show', $transaction->id) }}" class="more-button">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>                
        </table>
        <div>
        <a href="{{ route('loans.export') }}" class="export-button ">
            <i class="bi bi-archive" style="margin-right: 5px;"></i>
            Export to Excel
        </a>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{-- {{ $transactions->links('pagination::bootstrap-4') }} --}}
            </ul>
        </nav>
        </div>
    @endif
    
</div>
<!-- Pagination Buttons -->
<div id="paginationControls" class="d-flex justify-content-center mt-4"></div>

<script>
 let allTransactions = []; // Array to store all transactions

    // Gather all transaction data when the page loads
    document.addEventListener("DOMContentLoaded", () => {
        const transactions = document.querySelectorAll('.transaction-item');
        transactions.forEach(item => {
            const userName = item.cells[0].textContent.toLowerCase();
            const fullName = item.cells[1].textContent.toLowerCase();
            const receiver = item.cells[2].textContent.toLowerCase();
            const borrowedAt = item.cells[3].textContent.toLowerCase();
            const returnedAt = item.cells[4].textContent.toLowerCase();

            allTransactions.push({
                userName,
                fullName,
                receiver,
                borrowedAt,
                returnedAt,
                rowElement: item // Store the reference to the row element
            });
        });
    });

    function searchTransaction() {
        const input = document.getElementById('search').value.toLowerCase();

        // Filter transactions based on the input
        allTransactions.forEach(transaction => {
            const matches = transaction.userName.includes(input) ||
                            transaction.fullName.includes(input) ||
                            transaction.receiver.includes(input) ||
                            transaction.borrowedAt.includes(input) ||
                            transaction.returnedAt.includes(input);

            // Show or hide the row based on the search input
            transaction.rowElement.style.display = matches ? '' : 'none';
        });
    }

    const rowsPerPage = 10;
      const tableRows = Array.from(document.querySelectorAll('.transaction-item'));
      const totalPages = Math.ceil(tableRows.length / rowsPerPage);

      function displayPage(pageNumber) {
          const start = (pageNumber - 1) * rowsPerPage;
          const end = start + rowsPerPage;

          // Hide all rows, then show only the rows for the current page
          tableRows.forEach((row, index) => {
              row.style.display = index >= start && index < end ? '' : 'none';
          });
      }

      function createPaginationButtons() {
          const paginationControls = document.getElementById('paginationControls');
          paginationControls.innerHTML = '';

          for (let i = 1; i <= totalPages; i++) {
              const button = document.createElement('button');
              button.innerText = i;
              button.classList.add('btn', 'btn-primary', 'mx-1');
              button.onclick = () => displayPage(i);
              paginationControls.appendChild(button);
          }
      }

      // Initialize pagination
      displayPage(1);
      createPaginationButtons();
</script>
@endsection
