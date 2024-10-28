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

    .container-listproducts {
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        margin-bottom: 20px; /* Add spacing below the heading */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: linear-gradient(to right, #007bff, #00aaff); /* Gradient from dark blue to light blue */
        border: none;
        border-radius: 5px;
        color: white; /* Text color */
        padding: 6px 10px; /* Padding for buttons */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #00aaff, #007bff);
        color: black;
    }

    .btn-delete {
        background: linear-gradient(to right, #ff7e7e, #ff2c2c); /* Gradient from dark blue to light blue */
        border: none;
        border-radius: 5px;
        color: white; /* Text color */
        padding: 6px 10px; /* Padding for buttons */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-delete:hover {
        background: linear-gradient(to right, #ff2c2c, #ff7e7e);
        color: black;
    }

    .btn-success {
        background: linear-gradient(to right, #32CD32, #228B22); /* Gradient from light green to dark green */
        border: none;
        border-radius: 5px;
        color: white; /* Text color */
        padding: 8px 20px; /* Padding for buttons */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-success:hover {
        background: linear-gradient(to right, #228B22, #006400);
        background-color: #0056b3;
        color: black;
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: none;
    }

    .modal-title {
        color: #20c997; /* Title color in modal */
    }

    .form-label {
        color: #343a40; /* Label color in form */
    }

    .form-control {
        border-radius: 5px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 2rem; /* Adjust h1 font size for mobile */
        }

        .table {
            font-size: 14px; /* Adjust font size for smaller screens */
        }

        .btn-delete {
            margin-top: 5px;
        }
    }
</style>
<div class="container-listproducts">
    
    <div class="header-flex ">
        <h1>Daftar Barang</h1>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <span class="fa fa-plus-square">
        </button>
    </div>
    
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama barang</th>
                <th>Stok</th>
                <th>Di tambahkan pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <!-- Button trigger modal for Edit -->
                        
                            <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                <span class="fa fa-edit">
                            </button>
                            <form id="deleteForm{{ $product->id }}" action="{{ route('delete.product', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $product->id }}">
                                    <span class="fa fa-trash">
                                </button>
                            </form>
                        
                    </td>
                                     
                <!-- Form untuk Edit Produk -->
                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                                
                            </div>
                            <form id="editForm{{ $product->id }}" action="{{ route('products.update', $product->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name{{ $product->id }}" name="name" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock{{ $product->id }}" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock{{ $product->id }}" name="stock" value="{{ $product->stock }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-edit" data-id="{{ $product->id }}">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Form untuk Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan jumlah stock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-add">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // SweetAlert2 untuk Edit Produk
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let productId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Perubahan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editForm' + productId).submit();
                }
            });
        });
    });

    // SweetAlert2 untuk Tambah Produk
    document.querySelector('.btn-add').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Produk akan ditambahkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('addForm').submit();
            }
        });
    });
    
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data produk akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + productId).submit();
                }
            });
        });
    });

</script>

@endsection
