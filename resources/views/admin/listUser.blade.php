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

    .container-listuser {
        background-color: transparent;
        padding: 20px;
        margin-left: 20px;
        margin-right: 20px;
    
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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

    .table {
        border-radius: 20px;
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

<div class="container-listuser">
    <h1>Daftar Pengguna</h1>
    <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <span class="fa fa-plus-square">
    </button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" style="background-color: rgb(255, 255, 255);">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama lengkap</th>
                    <th>Email</th>
                    <th>No.  Telepon</th>
                    <th>Role</th>
                    
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->level }}</td>
                       
                    
                        
                        <td>
                        <!-- Button Edit -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                            <span class="fa fa-edit">
                        </button>
    
                        <!-- Button Delete -->
                        <form id="deleteForm{{ $user->id }}" action="{{ route('delete.user', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                                <span class="fa fa-trash">
                            </button>
                        </form>
    
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                                    </div>
                                    <form class="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $user->id }}" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password{{ $user->id }}" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                                <input type="password" class="form-control" id="password{{ $user->id }}" name="password" placeholder="Masukkan password baru">
                                            </div>
                                            <!-- Tambahan Role Checkbox -->
                                            <div class="mb-3">
                                                <label class="form-label">Role</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="level" id="superAdmin{{ $user->id }}" value="superAdmin" {{ $user->level == 'superAdmin' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="superAdmin{{ $user->id }}">SuperAdmin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="level" id="admin{{ $user->id }}" value="admin" {{ $user->level == 'admin' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="admin{{ $user->id }}">Admin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="level" id="nonAktif{{ $user->id }}" value="nonAktif" {{ $user->level == 'nonAktif' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="nonAktif{{ $user->id }}">NonAktif</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </td>
                </tr>

             
            @endforeach
        </tbody>
    </table>
</div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambahkan Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Tambahkan pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


 
    
    <script>
        // SweetAlert2 for Delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                let userId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "User ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm' + userId).submit();
                    }
                });
            });
        });

        document.querySelectorAll('.editUserForm').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Perubahan pada user akan disimpan!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});


    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "User akan ditambahkan!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });


    </script>
    

@endsection
