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

function toggleSearchBox() {
    const searchBox = document.getElementById("search-box");
    const toggleButton = document.getElementById('toggle-search');

    // Tampilkan atau sembunyikan kotak pencarian
    searchBox.style.display = searchBox.style.display === 'none' ? 'flex' : 'none';
    
    // Tambahkan atau hapus kelas aktif
    toggleButton.classList.toggle('active-button');
    
    // Fokus pada input pencarian jika ditampilkan
    if (searchBox.style.display === 'flex') {
        document.getElementById('search').focus(); 
    }
}

