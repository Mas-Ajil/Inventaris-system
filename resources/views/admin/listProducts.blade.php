@extends('layouts.main')
@section('container')


<style>
.btn-sm {
    margin-right: 10px;
}
.btn-ryu {
  width: 25px;
  height: 25px;
  display: inline-block; 
  text-align: center;
  vertical-align: middle;
  padding: 6px;
  
}


</style>
<div>
    
    <div class="header-flex ">
        <h1>Daftar Barang</h1>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Tambahkan Barang
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
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary btn-ryu" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                <span class="fa fa-edit">
                            </button>
                            <form id="deleteForm{{ $product->id }}" action="{{ route('delete.product', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-ryu btn-delete" data-id="{{ $product->id }}">
                                    <span class="fa fa-trash">
                                </button>
                            </form>
                        </div>
                                               
                <!-- Form untuk Edit Produk -->
                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
