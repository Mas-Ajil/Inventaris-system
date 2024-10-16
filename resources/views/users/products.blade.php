@extends('layouts.main')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Selection</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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

        h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #20c997; 
            margin-bottom: 20px;
        }

        .btn-add, .btn-remove, .btn-plus, .btn-minus {
            transition: background 0.3s ease, transform 0.3s;
        }

        .btn-add {
            background: linear-gradient(45deg, #007bff, #00c6ff); 
            border: none;
            color: white;
        }

        .btn-add:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }

        .btn-add:hover:enabled {
            background: linear-gradient(45deg, #0056b3, #0081c9); 
            transform: scale(1.05);
        }

        .btn-remove {
            background: linear-gradient(45deg, #dc3545, #ff4d4d); 
            border: none;
            color: white;
        }

        .btn-remove:hover {
            background: linear-gradient(45deg, #d94545, #e66d6d); 
            transform: scale(1.05);
        }

        .btn-minus {
            background: linear-gradient(45deg, #ffc107, #ffd700);
            color: white;
            border: none;
        }

        .btn-plus {
            background: linear-gradient(45deg, #28a745, #85e085);
            color: white;
            border: none;
        }

        .btn-minus:hover, .btn-plus:hover {
            transform: scale(1.05);
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .alert {
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h4 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <div class="row">
        <!-- Kolom Kiri: Daftar Produk -->
        <div class="col-md-6">
            <h4>List Barang</h4>
            
            <!-- Input pencarian -->
            <input type="text" id="search" class="form-control mb-3" placeholder="Cari barang..." onkeyup="searchProduct()">

            <ul class="list-group" id="product-list">
                @foreach ($products as $product)
                    <li class="list-group-item product-item">
                        <span>{{ $product->name }} (Stock: <span class="stock" data-id="{{ $product->id }}">{{ $product->stock }}</span>)</span>
                        <button class="btn btn-add btn-sm float-right" 
                                onclick="addProduct('{{ $product->id }}', '{{ $product->name }}')" 
                                {{ $product->stock == 0 ? 'disabled' : '' }}>
                            Add
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Kolom Kanan: Produk yang Dipilih -->
        <div class="col-md-6">
            <h4>Keranjang</h4>
            <ul class="list-group" id="selected-products"></ul>

            <div class="mt-4" id="loan-info" style="display: none;">
                <h4>Informasi Pinjam</h4>
                <form action="/submit-loan" method="POST" id="loan-form">
                    @csrf
                    <input type="hidden" name="selected_products" id="selected_products_input">

                    <div class="form-group">
                        <label for="user_name">Nama Peminjam</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="borrow_date">Tanggal Pinjam</label>
                        <input type="date" id="borrow_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="borrow_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="return_date">Estimasi Kembali</label>
                        <input type="date" id="return_date" name="return_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Additional notes"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" onclick="prepareSubmission(event)">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script>
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
}

function incrementProduct(id) {
    addProduct(id, selectedProducts[id].name);
}

function decrementProduct(id) {
    const stockElement = document.querySelector(`.stock[data-id='${id}']`);

    if (selectedProducts[id]) {
        selectedProducts[id].count--;
        stockElement.textContent = parseInt(stockElement.textContent) + 1; 

        // Re-enable Plus button if stock is available
        if (parseInt(stockElement.textContent) > 0) {
            document.getElementById(`plus-${id}`).removeAttribute('disabled');
        }

        if (selectedProducts[id].count === 0) {
            delete selectedProducts[id]; 
            document.getElementById(`plus-${id}`).setAttribute('disabled', true); // Disable Plus button if count is zero
        }

        displaySelectedProducts(); 
    }
}

function displaySelectedProducts() {
    const selectedProductsList = document.getElementById('selected-products');
    selectedProductsList.innerHTML = '';

    for (const id in selectedProducts) {
        const product = selectedProducts[id];
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `
            <span>${product.name}</span>
            <div class="d-flex align-items-center"> 
                <button class="btn btn-minus btn-sm" style="margin-left: 5px;" onclick="decrementProduct('${id}')" ${product.count === 1 ? 'disabled' : ''}>
                    <i class="bi bi-dash"></i>
                </button>
                <span style="margin: 0 10px;">${product.count}</span> <!-- Menampilkan jumlah di sini -->
                <button class="btn btn-plus btn-sm" style="margin-left: 5px;" onclick="incrementProduct('${id}')" id="plus-${id}">
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
    if (Object.keys(selectedProducts).length === 0) {
        event.preventDefault();
        alert('Please select at least one product before submitting the loan.');
    }
}


</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
