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

    .container {
        background-color: white;
        padding: 40px;
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

    .card-body {
        padding: 20px;
    }

    strong {
        color: #000000; /* Change strong text color */
    }

    p {
        margin: 0; /* Remove default margin for paragraphs */
        color: #6c757d; /* Slightly lighter color for the paragraph text */
    }

    .btn-primary {
        background: linear-gradient(to right, #007bff, #00aaff); /* Gradasi dari biru tua ke biru muda */
        border: none;
        border-radius: 5px;
        color: white; /* Warna teks */
        padding: 6px 20px; /* Padding untuk tombol */
        font-size: 16px; /* Ukuran font */
        cursor: pointer; /* Pointer saat hover */
        transition: background 0.3s ease; /* Animasi saat hover */
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #00aaff, #007bff);
        background-color: #0056b3;
        color: black;
    }

    .btn-success {
        background: linear-gradient(to right, #32CD32, #228B22); /* Gradasi dari biru tua ke biru muda */
        border: none;
        border-radius: 5px;
        color: white; /* Warna teks */
        padding:8px 20px; /* Padding untuk tombol */
        font-size: 16px; /* Ukuran font */
        cursor: pointer; /* Pointer saat hover */
        transition: background 0.3s ease; /* Animasi saat hover */
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
    }
</style>
<div class="container mt-5">
    <h1 style="">Profil Saya</h1>
    <div class="card">
        <div class="card-body">
            <!-- Mobile -->
            <div class="row">
                <div class="col-md-3">
                    <strong>Username</strong>
                </div>
                <div class="col-md-9">
                    <p id="name">{{ $user->name }}</p>
                </div>
            </div>
            <hr>

            <div class="row">
                <!-- Full Name -->
                <div class="col-md-3">
                    <strong>Nama Lengkap</strong>
                </div>
                <div class="col-md-9">
                    <p id="fullName">{{ $user->full_name }}</p>
                </div>
            </div>
            <hr>

            <!-- Email -->
            <div class="row">
                <div class="col-md-3">
                    <strong>Email</strong>
                </div>
                <div class="col-md-9">
                    <p id="email">{{ $user->email }}</p>
                </div>
            </div>
            <hr>

            <!-- Phone -->
            <div class="row">
                <div class="col-md-3">
                    <strong>No. Telp</strong>
                </div>
                <div class="col-md-9">
                    <p id="phone">{{ $user->phone }}</p>
                </div>
            </div>
            <hr>

            
            <!-- Address -->
            <div class="row">
                <div class="col-md-3">
                    <strong>Alamat</strong>
                </div>
                <div class="col-md-9">
                    <p id="address">{{ $user->address }}</p>
                </div>
            </div>
            <hr>

            <!-- Edit Button -->
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profil & Ganti Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form Edit Profil -->
          <form id="editProfileForm" action="{{ route('profile.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
  
              <!-- Field Username -->
              <div class="mb-3">
                  <label for="name" class="form-label">Username</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
              </div>
  
              <!-- Field Full Name -->
              <div class="mb-3">
                  <label for="full_name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}" required>
              </div>

              <!-- Field Full Name -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No telepon</label>
                <input type="phone" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="address" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
            </div>
  
  
              <!-- Field Ganti Password -->
              <div class="mb-3">
                  <label for="password" class="form-label">Password Baru (Opsional)</label>
                  <input type="password" class="form-control" id="password" name="password">
              </div>
  
              <!-- Field Konfirmasi Password -->
              <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Password Baru (Opsional)</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                  <small id="passwordMismatch" class="text-danger" style="display: none;">Passwords do not match</small>
              </div>
  
              <button type="submit" id="submitBtn" class="btn btn-success">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const passwordMismatch = document.getElementById('passwordMismatch');
        const submitBtn = document.getElementById('submitBtn');

        function checkPasswordMatch() {
            if (password.value !== passwordConfirmation.value) {
                passwordMismatch.style.display = 'block'; // Tampilkan pesan error
                submitBtn.disabled = true; // Disable tombol submit
            } else {
                passwordMismatch.style.display = 'none'; // Sembunyikan pesan error
                submitBtn.disabled = false; // Enable tombol submit
            }
        }

        // Jalankan fungsi ketika user mengetik di field password atau konfirmasi password
        password.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);
    });
</script>




@endsection
