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
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
        margin-right: 20px;
        margin-top: 20px;
        padding: 20px;
        margin-bottom: 20px;

    }
        #search-box {
            display: flex;
            transition: all 0.3s ease; /* Menambahkan animasi untuk transisi */
        }

        #search {
            width: 150px; /* Atur lebar input sesuai keinginan */
            min-width: 200px; /* Pastikan input tidak terlalu kecil */
            border-radius: 5px; /* Sudut melengkung */
        }

        .active-button {
            background: linear-gradient(45deg, #007bff, #00c6ff); /* Warna biru */
            color: white; /* Mengubah teks menjadi putih */
        }


        .input-group {
            width: fit-content; /* Mengatur lebar grup input agar sesuai */
        }


        .product-list {
            height: 650px; /* Set a fixed height for the product list */
            overflow-y: auto; /* Enable vertical scrolling */
           
        }
        
        #selected-products {
            max-height: 200px; /* Adjust this height according to your item height */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .container-listproducts .col-md-6 { /* Ensure columns can expand dynamically */
            transition: height 0.3s ease; /* Smooth transition when height changes */
        }

        
        h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #20c997; 
            margin-bottom: 20px;
        }

        .btn-outline-secondary{
            padding: 7 10px;
            margin-top: -17px;
        }

        .btn-add, .btn-remove, .btn-plus, .btn-minus, .btn-success {
            transition: background 0.3s ease, transform 0.3s;
        }

        .btn-add {
            background: linear-gradient(45deg, #007bff, #00c6ff); 
            border: none;
            color: white;
            padding: 7px 10px;
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
            padding: 7px 10px;
        }

        .btn-remove:hover {
            background: linear-gradient(45deg, #d94545, #e66d6d); 
            transform: scale(1.05);
        }

        .btn-minus {
            background: linear-gradient(45deg, #ffc107, #ffd700);
            color: white;
            border: none;
            padding: 7px 10px;
        }

        .btn-plus {
            background: linear-gradient(45deg, #28a745, #85e085);
            color: white;
            border: none;
            padding: 7px 10px;
        }

        .btn-minus:hover, .btn-plus:hover, .btn-success:hover {
            transform: scale(1.05);
        }

        .btn-success {
            background: linear-gradient(45deg, #32CD32, #228B22);
            border: none;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #228B22, #006400);
            color: black;
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

        .input-group {
            width: 245px;
            
        }

        .input-group-text {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.375rem 0.75rem; /* Padding simetris di sekitar ikon */
            height: 38px; /* Sesuaikan tinggi input agar sesuai */
            border-right: none; /* Menghilangkan border kanan agar lebih mulus dengan input */
        }

        .input-group .form-control {
            height: 30px;
            padding: 0.375rem 0.75rem;
            border-left: none; /* Menghilangkan border kiri agar mulus dengan ikon */
        }

        .bi-search {
            height: 30px;
            font-size: 1rem;
            vertical-align: middle; /* Sesuaikan ukuran ikon */
        }


        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h4 {
                font-size: 1.2rem;
            }
            
            .cart-title {
                margin: 10px 0px;
            }

        }
    </style>


<div class="container-products">
    <div class="row">
        <!-- Kolom Kiri: Daftar Produk -->
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center">
                <h4>List Barang</h4>
                <!-- Container for Search Button and Search Box -->
                <div class="d-flex align-items-center">
                    <!-- Search Button -->
                    <button class="btn btn-outline-secondary" id="toggle-search" onclick="toggleSearchBox()">
                        <i class="bi bi-search"></i>
                    </button>
                    
                    <!-- Hidden Search Box -->
                    <div id="search-box" class="input-group ms-2" style="display: none; max-width: 200px max;">
                        <input type="text" id="search" class="form-control" onkeyup="searchProduct()" placeholder="Cari barang...">
                    </div>
                </div>
            </div>

                <div class="product-list" id="product-list"> <!-- Added a new container for scrolling -->
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item product-item">
                                <span>{{ $product->name }}</span>
                                <div class="d-flex align-items-center">
                                    <span class="text-muted me-3">Stock: <span class="stock" data-id="{{ $product->id }}">{{ $product->stock }}</span></span>
                                    <button class="btn btn-add btn-sm" 
                                            onclick="addProduct('{{ $product->id }}', '{{ $product->name }}')" 
                                            {{ $product->stock == 0 ? 'disabled' : '' }}>
                                            <i class="bi bi-cart"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
           
        </div>

        <!-- Kolom Kanan: Produk yang Dipilih -->
        <div class="col-md-6">
            <h4 class="cart-title">Keranjang</h4>
            <ul class="list-group" id="selected-products"></ul>
            <div class="mt-4" id="loan-info" style="display: none;">
                <h4>Informasi Pinjam</h4>
                <form action="/submit-loan" method="POST" id="loan-form">
                    @csrf
                    <input type="hidden" name="selected_products" id="selected_products_input">

                    <div class="form-group">
                        <label for="user_name">Nama Peminjam</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="masukkan nama peminjam" required>
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
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="masukkan catatan tambahan"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" onclick="prepareSubmission(event)">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- js kusus products --}}
<script src="/js/products.js"></script>

@endsection
