let allTransactions = []; // Array to store all transactions
let filteredTransactions = []; // Array for filtered transactions
const rowsPerPage = 10;
let currentPage = 1; // Track the current page globally

document.addEventListener("DOMContentLoaded", () => {
    const transactions = document.querySelectorAll('.transaction-item');
    transactions.forEach(item => {
        const userName = item.cells[0].textContent.toLowerCase();
        const fullName = item.cells[1].textContent.toLowerCase();
        const borrowedAt = item.cells[2].textContent.toLowerCase();
        const returnedAt = item.cells[3].textContent.toLowerCase();

        allTransactions.push({
            userName,
            fullName,
            borrowedAt,
            returnedAt,
            rowElement: item // Store the reference to the row element
        });
    });
    filteredTransactions = [...allTransactions]; // Start with all transactions
    displayPage(currentPage);
    createPaginationButtons();
});

function searchTransaction() {
    const input = document.getElementById('search').value.toLowerCase();

    // Filter transactions based on the input
    filteredTransactions = allTransactions.filter(transaction => {
        return transaction.userName.includes(input) ||
               transaction.fullName.includes(input) ||
               transaction.borrowedAt.includes(input) ||
               transaction.returnedAt.includes(input);
    });

    // Reset pagination based on the search results
    currentPage = 1; // Reset to the first page
    displayPage(currentPage);
    createPaginationButtons();
}

function displayPage(pageNumber) {
    currentPage = pageNumber; // Update the current page
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

    // Jika hanya satu halaman atau kurang, tidak perlu menampilkan pagination
    if (totalPages < 1) return;

    const paginationList = document.createElement('ul');
    paginationList.classList.add('pagination');

    // Tambahkan tombol "Previous"
    const previousItem = document.createElement('li');
    previousItem.classList.add('page-item');
    if (currentPage === 1) previousItem.classList.add('disabled');

    const previousLink = document.createElement('a');
    previousLink.classList.add('page-link');
    previousLink.href = '#';
    previousLink.innerHTML = '&laquo;'; // Panah kiri

    previousLink.onclick = (e) => {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            displayPage(currentPage);
            createPaginationButtons();
        }
    };

    previousItem.appendChild(previousLink);
    paginationList.appendChild(previousItem);

    // Menentukan range halaman yang ditampilkan
    const maxVisiblePages = 5; // Jumlah maksimal halaman yang terlihat
    let startPage = Math.max(currentPage - Math.floor(maxVisiblePages / 2), 1);
    let endPage = Math.min(startPage + maxVisiblePages - 1, totalPages);

    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(endPage - maxVisiblePages + 1, 1);
    }

    // Tambahkan nomor halaman
    for (let i = startPage; i <= endPage; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (i === currentPage) pageItem.classList.add('active');

        const pageLink = document.createElement('a');
        pageLink.classList.add('page-link');
        pageLink.href = '#';
        pageLink.innerText = i;

        pageLink.onclick = (e) => {
            e.preventDefault();
            currentPage = i;
            displayPage(currentPage);
            createPaginationButtons();
        };

        pageItem.appendChild(pageLink);
        paginationList.appendChild(pageItem);
    }

    // Tambahkan tombol "Next"
    const nextItem = document.createElement('li');
    nextItem.classList.add('page-item');
    if (currentPage === totalPages) nextItem.classList.add('disabled');

    const nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = '#';
    nextLink.innerHTML = '&raquo;'; // Panah kanan

    nextLink.onclick = (e) => {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            displayPage(currentPage);
            createPaginationButtons();
        }
    };

    nextItem.appendChild(nextLink);
    paginationList.appendChild(nextItem);

    paginationControls.appendChild(paginationList);
}

