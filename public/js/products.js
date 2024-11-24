const selectedProducts = {};

function addProduct(id, name) {
    const stockElement = document.querySelector(`.stock[data-id='${id}']`);
    let stock = parseInt(stockElement.textContent);

    if (stock > 0) {
        if (selectedProducts[id]) {
            selectedProducts[id].count++;
        } else {
            selectedProducts[id] = { id: id, name: name, count: 1 };
            document.querySelector(`button[onclick="addProduct('${id}', '${name}')"]`).setAttribute('disabled', true);
        }
        stockElement.textContent = stock - 1; 
        displaySelectedProducts(); 
        
        // Disable Plus button if stock is 0
        if (stock - 1 === 0) {
            document.getElementById(`plus-${id}`).setAttribute('disabled', true);
        }
    } else {
        alert('Stock is out for this product.');
    }

    updateRemoveAllButtonVisibility();
}

function removeProduct(id) {
    if (selectedProducts[id]) {
        const stockElement = document.querySelector(`.stock[data-id='${id}']`);
        stockElement.textContent = parseInt(stockElement.textContent) + selectedProducts[id].count; 
        const addButton = document.querySelector(`button[onclick="addProduct('${id}', '${selectedProducts[id].name}')"]`);
        addButton.removeAttribute('disabled');
        delete selectedProducts[id]; 
        displaySelectedProducts(); 
    }

    updateRemoveAllButtonVisibility();
}

function incrementProduct(id) {
    const stockElement = document.querySelector(`.stock[data-id='${id}']`);
    let stock = parseInt(stockElement.textContent);

    if (stock > 0) {
        selectedProducts[id].count++;
        stockElement.textContent = stock - 1; 
        displaySelectedProducts(); 

        if (stock - 1 === 0) {
            document.getElementById(`plus-${id}`).setAttribute('disabled', true); // Disable Plus button if no stock
        }
    } else {
        alert('No more stock available.');
    }
}

function decrementProduct(id) {
    const stockElement = document.querySelector(`.stock[data-id='${id}']`);

    if (selectedProducts[id]) {
        selectedProducts[id].count--;
        stockElement.textContent = parseInt(stockElement.textContent) + 1;

        if (parseInt(stockElement.textContent) > 0) {
            document.getElementById(`plus-${id}`).removeAttribute('disabled');
        }

        if (selectedProducts[id].count === 0) {
            delete selectedProducts[id];
        }

        displaySelectedProducts(); 
    }
}


function displaySelectedProducts() {
    const selectedProductsList = document.getElementById('selected-products');
    selectedProductsList.innerHTML = '';

    for (const id in selectedProducts) {
        const product = selectedProducts[id];
        const stockElement = document.querySelector(`.stock[data-id='${id}']`);
        const currentStock = parseInt(stockElement.textContent); // Ambil stok terkini

        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `
            <span>${product.name}</span>
            <div class="d-flex align-items-center"> 
                <button class="btn btn-minus btn-sm" style="margin-left: 5px;" onclick="decrementProduct('${id}')" ${product.count === 1 ? 'disabled' : ''}>
                    <i class="bi bi-dash"></i>
                </button>
                <span style="margin: 0 10px;">${product.count}</span>
                <button class="btn btn-plus btn-sm" style="margin-left: 5px;" onclick="incrementProduct('${id}')" id="plus-${id}" ${currentStock === 0 ? 'disabled' : ''}>
                    <i class="bi bi-plus"></i>
                </button>
                <button class="btn btn-remove btn-sm" style="margin-left: 5px;" onclick="removeProduct('${id}')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        selectedProductsList.appendChild(li);
    }

    document.getElementById('loan-info').style.display = Object.keys(selectedProducts).length > 0 ? 'block' : 'none';
    document.getElementById('selected_products_input').value = JSON.stringify(selectedProducts);
}

function searchProduct() {
    const query = document.getElementById('search').value.toLowerCase();
    const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(item => {
        const productName = item.textContent.toLowerCase();
        item.style.display = productName.includes(query) ? 'flex' : 'none';
    });
}

// Set minimum date for return_date to today
document.addEventListener('DOMContentLoaded', function () {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format YYYY-MM-DD
        document.getElementById('return_date').setAttribute('min', formattedDate);
    });

    function prepareSubmission(event) {
    const selectedCount = Object.keys(selectedProducts).length;
    
    // Get form input elements
    const userName = document.getElementById('user_name').value.trim();
    const borrowDate = document.getElementById('borrow_date').value.trim();
    const returnDate = document.getElementById('return_date').value.trim();

    // Check if all required fields are filled
    if (selectedCount === 0) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: 'Silakan tambahkan setidaknya satu produk sebelum mengirim.',
        });
    } else if (!userName || !borrowDate || !returnDate) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: 'Ada kolom yang masih kosong. Isi terlebih dahulu!',
        });
    } else {
        event.preventDefault(); // Prevent the default form submission
        Swal.fire({
            title: "Apakah Anda yakin ingin mengirim data peminjaman?",
            text: "Jika Anda yakin, klik tombol di bawah ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, Kirim!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('loan-form').submit(); // Submit the form if confirmed
                Swal.fire({
                    title: "Terkirim!",
                    text: "Data peminjaman Anda telah dikirim.",
                    icon: "success"
                });
            }
        });
    }
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

function removeAllProducts() {
    // Ambil elemen keranjang dan daftar produk
    const selectedProductsList = document.getElementById('selected-products');

    // Kembalikan stok semua produk di keranjang dan aktifkan tombol "Add"
    Object.keys(selectedProducts).forEach(productId => {
        const productStock = document.querySelector(`.stock[data-id="${productId}"]`);
        const quantity = selectedProducts[productId].count;

        // Update stok produk
        if (productStock) {
            const currentStock = parseInt(productStock.textContent);
            productStock.textContent = currentStock + quantity; // Kembalikan stok ke jumlah sebelumnya
        }

        // Aktifkan tombol "Add" jika stok tersedia
        const addButton = document.querySelector(`button[onclick="addProduct('${productId}', '${selectedProducts[productId].name}')"]`);
        if (addButton) {
            addButton.removeAttribute('disabled');
        }
    });

    // Kosongkan selectedProducts (menghapus produk dari keranjang)
    for (const productId in selectedProducts) {
        delete selectedProducts[productId]; // Menghapus produk satu per satu
    }

    // Perbarui tampilan keranjang agar kosong
    selectedProductsList.innerHTML = ''; // Kosongkan elemen keranjang

    // Sembunyikan form pinjam jika keranjang kosong
    document.getElementById('loan-info').style.display = 'none';

    // Pastikan tombol "Remove All" diupdate
    updateRemoveAllButtonVisibility();
}



function updateRemoveAllButtonVisibility() {
    const selectedProducts = document.getElementById('selected-products');
    const removeAllButton = document.getElementById('remove-all');

    // Hitung jumlah item di keranjang
    const itemCount = selectedProducts.querySelectorAll('.list-group-item').length;

    // Tampilkan tombol jika jumlah item lebih dari 2
    if (itemCount > 1) {
        removeAllButton.style.display = 'inline-block';
    } else {
        removeAllButton.style.display = 'none';
    }
}


