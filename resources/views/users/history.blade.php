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

.container-products {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 20px;
    overflow-x: auto; /*plis bang jangan diilangin anjay capek kali aku*/

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
    background: linear-gradient(45deg, #32CD32, #228B22);
    border: none;
    color: #fff;
    padding: 4px 14px; /* Adjust padding for better alignment */
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

.pagination-button {
    background-color: white; /* Default background for inactive buttons */
    color: #007bff; /* Text color for inactive buttons */
    border: 1px solid #007bff; /* Blue border for inactive buttons */
    transition: background 0.3s ease, color 0.3s ease;
    margin: 0 5px; /* Add space between buttons */
    padding: 0.5rem 1rem; /* Adjust padding for better size */
}

.pagination-button:hover {
    background-color: #007bff; /* Blue background on hover for inactive buttons */
    color: white; /* White text on hover */
}

.pagination-button.active {
    background-color: #007bff; /* Blue background for active button */
    color: white; /* White text for active button */
    border: 1px solid #007bff; /* Consistent border color */
    cursor: default; /* Indicate this is not clickable */
}


/* Responsive */
@media (max-width: 768px) {

    .header-flex {
        flex-direction: column; /* Stack h1 and button on small screens */
        align-items: flex-start;
    }

    table, th, td {
        font-size: 0.9rem; /* Adjust font size for smaller screens */
    }
    
}

  </style>

<div class="container-products">
    <div class="header-flex">
        <h1>Riwayat Peminjaman</h1>
        
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
        <div class="input-group" style="width: 200px;">
            <span class="input-group-text" id="search-addon">
                <i class="bi-search"></i>
            </span>
            <input type="text" id="search" onkeyup="searchTransaction()" class="form-control" placeholder="Cari riwayat..." aria-describedby="search-addon">
        </div>
        
        <a href="{{ route('loans.export') }}" class="export-button ">
            <i class="bi bi-archive" style="margin-right: 5px;"></i>
            Export
        </a>
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
            
            <div id="paginationControls" class="d-flex justify-content-end mt-4"></div>
        </div>
    @endif
    
</div>
<!-- Pagination -->


<script>
 let allTransactions = []; // Array to store all transactions
let filteredTransactions = []; // Array for filtered transactions
const rowsPerPage = 10;

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
    filteredTransactions = [...allTransactions]; // Start with all transactions
    displayPage(1);
    createPaginationButtons();
});

function searchTransaction() {
    const input = document.getElementById('search').value.toLowerCase();

    // Filter transactions based on the input
    filteredTransactions = allTransactions.filter(transaction => {
        return transaction.userName.includes(input) ||
               transaction.fullName.includes(input) ||
               transaction.receiver.includes(input) ||
               transaction.borrowedAt.includes(input) ||
               transaction.returnedAt.includes(input);
    });

    // Reset pagination based on the search results
    displayPage(1);
    createPaginationButtons();
}

function displayPage(pageNumber) {
    const start = (pageNumber - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    // Hide all rows, then show only the rows for the current page from filtered results
    allTransactions.forEach(transaction => {
        transaction.rowElement.style.display = 'none'; // Hide all rows
    });

    filteredTransactions.slice(start, end).forEach(transaction => {
        transaction.rowElement.style.display = ''; // Display rows for the current page
    });
}

function createPaginationButtons() {
    const paginationControls = document.getElementById('paginationControls');
    paginationControls.innerHTML = '';

    const totalPages = Math.ceil(filteredTransactions.length / rowsPerPage);
    const paginationList = document.createElement('ul');
    paginationList.classList.add('pagination');

    // Helper function to create page items
    const createPageItem = (pageNumber, isActive = false) => {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (isActive) pageItem.classList.add('active');

        const pageLink = document.createElement('a');
        pageLink.classList.add('page-link');
        pageLink.href = '#';
        pageLink.innerText = pageNumber;

        pageLink.onclick = (e) => {
            e.preventDefault();
            displayPage(pageNumber);
            createPaginationButtons(); // Refresh pagination on click
        };

        pageItem.appendChild(pageLink);
        return pageItem;
    };

    // Add "Previous" button
    const previousItem = document.createElement('li');
    previousItem.classList.add('page-item');
    if (currentPage === 1) previousItem.classList.add('disabled');

    const previousLink = document.createElement('a');
    previousLink.classList.add('page-link');
    previousLink.href = '#';
    previousLink.innerHTML = '&laquo;'; // Left arrow

    previousLink.onclick = (e) => {
        e.preventDefault();
        if (currentPage > 1) {
            displayPage(currentPage - 1);
            createPaginationButtons(); // Refresh pagination
        }
    };

    previousItem.appendChild(previousLink);
    paginationList.appendChild(previousItem);

    // Display only 3 page numbers at a time
    const startPage = Math.max(currentPage - 1, 1);
    const endPage = Math.min(currentPage + 1, totalPages);

    for (let i = startPage; i <= endPage; i++) {
        const pageItem = createPageItem(i, i === currentPage);
        paginationList.appendChild(pageItem);
    }

    // Add "Next" button
    const nextItem = document.createElement('li');
    nextItem.classList.add('page-item');
    if (currentPage === totalPages) nextItem.classList.add('disabled');

    const nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = '#';
    nextLink.innerHTML = '&raquo;'; // Right arrow

    nextLink.onclick = (e) => {
        e.preventDefault();
        if (currentPage < totalPages) {
            displayPage(currentPage + 1);
            createPaginationButtons(); // Refresh pagination
        }
    };

    nextItem.appendChild(nextLink);
    paginationList.appendChild(nextItem);
    paginationControls.appendChild(paginationList);
}

// Track the current page globally
let currentPage = 1;

function displayPage(pageNumber) {
    currentPage = pageNumber; // Set the current page
    const start = (pageNumber - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    allTransactions.forEach(transaction => {
        transaction.rowElement.style.display = 'none';
    });

    filteredTransactions.slice(start, end).forEach(transaction => {
        transaction.rowElement.style.display = '';
    });
}




</script>
@endsection
