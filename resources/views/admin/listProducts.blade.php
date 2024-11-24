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
        margin: 20px;
        overflow-x: auto;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        margin-bottom: 20px; /* Add spacing below the heading */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-removeall {
        background: linear-gradient(to right, #dc3545, #ff6b6b); /* Gradient from dark blue to light blue */
        border: none;
        border-radius: 5px;
        color: white; /* Text color */
        padding: 3px 10px; /* Padding for buttons */
        font-size: 14px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-removeall:hover {
        background: linear-gradient(to right, #b21f2d, #ff3d3d);
        color: black;
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
        padding: 6px 10px;
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-success:hover {
        background: linear-gradient(to right, #228B22, #006400);
        background-color: #0056b3;
        color: black;
    }

    .btn-danger {
        background: linear-gradient(to right, #dc3545, #ff6b6b); /* Gradient from dark blue to light blue */
        border: none;
        border-radius: 5px;
        color: white; /* Text color */
        padding: 6px 10px; /* Padding for buttons */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer on hover */
        transition: background 0.3s ease; /* Animation on hover */
    }

    .btn-danger:hover {
        background: linear-gradient(to right, #b21f2d, #ff3d3d);
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
    
    <div class="header-flex">
        <h1>Daftar Barang</h1>
        <button type="button" class="btn btn-success float-end ms-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <span class="fa fa-plus-square"></span>
        </button>

        <a href="{{ route('products.export') }}" type="button" class="btn btn-primary float-end ms-2" id="exportButton">
            <span class="fa fa-download"></span>
        </a>

        <button id="removeButton" class="btn btn-removeall" style="display: none;">Remove</button>
    </div>
    
    
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th> <!-- Checkbox untuk memilih semua -->
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
                    <td><input type="checkbox" class="product-checkbox" data-id="{{ $product->id }}"></td>
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
                <h5 class="modal-title" id="addProductModalLabel">Tambahkan Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabs for Add Product and Import Product -->
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#add-product" type="button" role="tab" aria-controls="add-product" aria-selected="true">Tambahkan Barang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="import-tab" data-bs-toggle="tab" data-bs-target="#import-product" type="button" role="tab" aria-controls="import-product" aria-selected="false">Import Barang</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="productTabContent">
                    <!-- Add Product Form -->
                    <div class="tab-pane fade show active" id="add-product" role="tabpanel" aria-labelledby="add-tab">
                        <form id="addForm" action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan jumlah stock" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success btn-add">Submit</button>
                            </div>
                        </form>
                    </div>

                    <!-- Import Products Form -->
                    <div class="tab-pane fade" id="import-product" role="tabpanel" aria-labelledby="import-tab">
                        <form id="importForm" action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="importFile" class="form-label">Import File (Excel)</label>
                                <input type="file" class="form-control" id="importFile" name="file" accept=".xls,.xlsx" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const removeButton = document.getElementById('removeButton');
        // const checkboxes = document.querySelectorAll('.product-checkbox');
        // checkboxes.forEach(checkbox => checkbox.checked = false);

        // Reset semua checkbox termasuk Select All saat halaman dimuat
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = false;
        }
        productCheckboxes.forEach(checkbox => checkbox.checked = false);
        
        // Menampilkan tombol Remove jika ada checkbox yang dipilih
        function toggleRemoveButton() {
            const anyChecked = Array.from(productCheckboxes).some(cb => cb.checked);
            removeButton.style.display = anyChecked ? 'inline-block' : 'none';
        }
        
        // Event untuk memilih semua checkbox
        selectAllCheckbox.addEventListener('change', function () {
            productCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
            toggleRemoveButton();
        });

        // Event untuk checkbox individu
        productCheckboxes.forEach(cb => {
            cb.addEventListener('change', toggleRemoveButton);
        });

        // Event untuk tombol Remove
        removeButton.addEventListener('click', function () {
            const selectedIds = Array.from(productCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.dataset.id);

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Produk yang sudah terpilih akan dihapus',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus Produk!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                if (result.isConfirmed) {
                            // Kirim permintaan ke server untuk menghapus produk
                            fetch('/products/remove', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ ids: selectedIds })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Hapus baris dari tabel
                                        selectedIds.forEach(id => {
                                            const row = document.querySelector(`.product-checkbox[data-id="${id}"]`).closest('tr');
                                            row.remove();
                                        });
                                        toggleRemoveButton();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Terhapus',
                                            text: 'Produk sudah dihapus!',
                                            timer: 1000,
                                            showConfirmButton: false
                                    });

                                    // Sembunyikan tombol "Remove All"
                                    document.getElementById('removeButton').style.display = 'none';
                                    } else {
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Failed!',
                                        text: 'Failed to remove products. Please try again later.'});
                                    }
                                });
                }})
            }
        });
    });
    
</script>

@endsection
