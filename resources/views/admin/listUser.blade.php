@extends('layouts.sidebar')
@section('container')

<div class="container">
    <h1>Daftar User</h1>
    <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Add User
    </button>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <!-- Button Edit -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                            Edit
                        </button>
    
                        <!-- Button Delete -->
                        <form id="deleteForm{{ $user->id }}" action="{{ route('delete.user', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                                Delete
                            </button>
                        </form>
    
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password{{ $user->id }}" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                                <input type="password" class="form-control" id="password{{ $user->id }}" name="password" placeholder="Masukkan password baru">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save changes</button>
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

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


 
    
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
        });
    });


    </script>
    

@endsection
