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
<<<<<<< HEAD
        }
=======
    }
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7
        #search-box {
            display: flex;
            transition: all 0.3s ease;
        }

        #search {
            width: 150px;
            min-width: 200px; 
            border-radius: 5px;
        }

        .active-button {
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: white;
        }


        .input-group {
            width: fit-content;
        }


        .product-list {
            height: 650px;
            overflow-y: auto;
           
        }
        
        #selected-products {
            max-height: 200px;
            overflow-y: auto;
        }

        .container-listproducts .col-md-6 { 
            transition: height 0.3s ease; 
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

        .btn-removeall {
            background: transparent; 
            border: 2px solid red; 
            color: red;
            padding: 3px 10px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-removeall:hover {
            background: linear-gradient(45deg, #ff4d4d, #ff1a1a);
            color: white; 
            border: 2px solid transparent;
            transform: scale(1.05);
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
            padding: 7px 7px;
        }

        .btn-plus {
            background: linear-gradient(45deg, #28a745, #85e085);
            color: white;
            border: none;
            padding: 7px 7px;
        }

        .btn-plus:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }

        .btn-minus:disabled {
            background: #cccccc;
            cursor: not-allowed;
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
            width: 200px;
            flex-wrap: wrap;
            box-sizing: border-box;
        }
<<<<<<< HEAD
=======

        
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7

        .input-group .form-control {
            height: 30px;
            padding: 0.375rem 0.75rem;
            max-width: 100%;
            
        }

        .bi-search {
            height: 30px;
            font-size: 1rem;
            vertical-align: middle;
        }

        .stock {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            padding: 5px 10px;
            font-weight: bold;
            color: #343a40;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px; 
        }

        .stock:hover {
            background: linear-gradient(45deg, #32CD32, #228B22); 
            color: white; 
            transform: scale(1.05); 
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
            transition: all 0.3s ease; 
        }


        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h4 {
                font-size: 1.2rem;
                text-align: center;
            }
            
            .cart-title {
                margin: 15px 0px;
            }
            .input-group {
                width: 100%;
                max-width: 90%;
            }
            .input-group {
                width: 100%;
                max-width: 90%;
            }

            .container-products .d-flex.justify-content-between {
<<<<<<< HEAD
                flex-direction: column;
                align-items: flex-start; 
            }

            #search-box {
                margin-top: -5px; 
                width: 100%; 
            }

            #search {
                width: 100%; 
            }

            .btn-removeall {
                margin-bottom : 5px;
=======
                flex-direction: column; /* Stack vertically */
                align-items: flex-start; /* Align elements to the left */
            }

            #search-box {
                margin-top: -5px; /* Add space between the title and search box */
                width: 100%; /* Full width on small screens */
            }

            #search {
                width: 100%; /* Make search box take full width */
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7
            }

            .btn-outline-secondary {
                margin-top: 0px;
                margin-bottom: 20px;
            }
<<<<<<< HEAD
    }  
</style>
=======
}  
    </style>
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7


<div class="container-products">
    <div class="row">
        <!-- Kolom Kiri: Daftar Produk -->
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center">
                <h4>List Barang</h4>
                <div class="d-flex align-items-center">
                    <!-- Search Button -->
                    <button class="btn btn-outline-secondary" id="toggle-search" onclick="toggleSearchBox()">
                        <i class="bi bi-search"></i>
                    </button>
                  
                    <!-- Hidden Search Box -->
                    <div id="search-box" class="input-group ms-2" style="display: none">
                        <input type="text" id="search" class="form-control" onkeyup="searchProduct()" placeholder="Cari barang...">
                    </div>
                </div>
            </div>

                <div class="product-list" id="product-list"> 
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item product-item">
                                <span>{{ $product->name }}</span>
                                <div class="d-flex align-items-center">
                                    <span class="text-muted me-3"><i class="bi bi-box"></i> <strong>Stok:</strong> <span class="stock" data-id="{{ $product->id }}">{{ $product->stock }}</span></span>
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
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="cart-title">Keranjang</h4>
                <!-- Tombol Remove All -->
                <button class="btn btn-removeall" id="remove-all" style="display: none;" onclick="removeAllProducts()">Remove All</button>
            </div>
            <ul class="list-group" id="selected-products"></ul>
            <div class="mt-4" id="loan-info" style="display: none;">
                <h4>Informasi Peminjaman</h4>
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
