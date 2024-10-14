@extends('layouts.main')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Selection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Styling yang sudah ada */

        body {
            overflow: -moz-scrollbars-none; /*  Firefox */
            -ms-overflow-style: none;  /*  Internet Explorer and Edge */
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('/assets/bg-all.jpg') no-repeat center center fixed; 
            background-size: cover; 
            color: #343a40;
        }

        body::-webkit-scrollbar {
            display: none; /*  Chrome, Safari, and Opera */
        }

        .btn-add {
            background: linear-gradient(45deg, #007bff, #00c6ff); /* Blue gradient */
            border: none;
            color: white;
            padding: 5px 10px;
            transition: background 0.3s ease, transform 0.3s;
        }

        .btn-add:disabled {
            background: #cccccc; /* Grey color when disabled */
            cursor: not-allowed;
        }

        .btn-add:hover:enabled {
            background: linear-gradient(45deg, #0056b3, #0081c9); /* Darker blue on hover */
            transform: scale(1.05); /* Slight scale effect on hover */
        }

        .btn-remove {
            background: linear-gradient(45deg, #ff4d4d, #ff7979); /* Red gradient */
            border: none;
            color: white;
            transition: background 0.3s ease, transform 0.3s;
        }

        .btn-remove:hover {
            background: linear-gradient(45deg, #d94545, #e66d6d); /* Darker red on hover */
            transform: scale(1.05); /* Slight scale effect on hover */
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
            <h4>Product List</h4>
            
            <!-- Input pencarian -->
            <input type="text" id="search" class="form-control mb-3" placeholder="Search product..." onkeyup="searchProduct()">

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
            <h4>Selected Products</h4>
            <ul class="list-group" id="selected-products"></ul>

            <div class="mt-4" id="loan-info" style="display: none;">
                <h4>Loan Information</h4>
                <form action="/submit-loan" method="POST" id="loan-form">
                    @csrf
                    <input type="hidden" name="selected_products" id="selected_products_input">

                    <div class="form-group">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="borrow_date">Borrow Date</label>
                        <input type="date" id="borrow_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="borrow_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="return_date">Return Date</label>
                        <input type="date" id="return_date" name="return_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Additional notes"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" onclick="prepareSubmission(event)">Submit Loan</button>
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
            }
            stockElement.textContent = stock - 1; // Kurangi stok
            displaySelectedProducts(); // Panggil untuk memperbarui tampilan produk yang dipilih
        } else {
            alert('Stock is out for this product.');
        }

        // Cek jika stok habis, nonaktifkan tombol
        if (parseInt(stockElement.textContent) === 0) {
            document.querySelector(`button[onclick="addProduct('${id}', '${name}')"]`).setAttribute('disabled', true);
        }
    }

    function removeProduct(id) {
    if (selectedProducts[id]) {
        const stockElement = document.querySelector(`.stock[data-id='${id}']`);
        stockElement.textContent = parseInt(stockElement.textContent) + 1; // Tambah stok kembali

        selectedProducts[id].count--; // Kurangi jumlah produk

        if (selectedProducts[id].count === 0) {
            delete selectedProducts[id]; // Jika jumlahnya 0, hapus produk dari list
        }

        displaySelectedProducts(); // Perbarui tampilan produk yang dipilih
    }
}


    function displaySelectedProducts() {
        const selectedProductsList = document.getElementById('selected-products');
        selectedProductsList.innerHTML = '';

        for (const id in selectedProducts) {
            const product = selectedProducts[id];
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = `
                <span>${product.name}</span> (Quantity: ${product.count})
                <button class="btn btn-remove btn-sm float-right" onclick="removeProduct('${id}')">Remove</button>
            `;
            selectedProductsList.appendChild(li);
        }

        // Tampilkan informasi pinjaman jika ada produk yang dipilih
        document.getElementById('loan-info').style.display = Object.keys(selectedProducts).length > 0 ? 'block' : 'none';
    }

    function prepareSubmission(event) {
        event.preventDefault();
        const selectedProductsInput = document.getElementById('selected_products_input');
        selectedProductsInput.value = JSON.stringify(selectedProducts);
        
        if (Object.keys(selectedProducts).length === 0) {
            alert('Please select at least one product before submitting.');
            return;
        }
        
        document.getElementById('loan-form').submit();
    }

    function searchProduct() {
        const searchValue = document.getElementById('search').value.toLowerCase();
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(function(item) {
            const productName = item.textContent.toLowerCase();
            if (productName.includes(searchValue)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
@endsection
