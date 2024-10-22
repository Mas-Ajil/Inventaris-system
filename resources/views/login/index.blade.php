<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('logoku.png') }}" type="image/png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('/assets/bg-login.jpg') no-repeat center center fixed; 
            background-size: cover; 
            color: #e0e0e0; /* Light text color */
            height: 100vh;
            overflow: hidden; /* Disable scrolling */
        }

        .container {
            background-color: transparent; /* Dark container with transparency */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #9d9d9d;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff34, #00c6ff);
            border: none;
            color: white;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #0081c9);
        }

        .alert {
            margin-bottom: 20px;
        }

        .input-group-text {
            background-color: #333;
            border-right: none;
            color: #e0e0e0; /* Light text color for input group icons */
        }

        .form-control {
    background-color: rgba(255, 255, 255, 0.2); /* Transparansi dengan warna putih sedikit */
    color: #e0e0e0; /* Warna teks menjadi terang */
    border: 1px solid rgba(255, 255, 255, 0.2); /* Border juga transparan */
    height: 50px; /* Tinggi input form */
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.3); /* Sedikit lebih terang saat fokus */
    color: #e0e0e0;
    border-color: rgba(255, 255, 255, 0.4); /* Border lebih terlihat saat fokus */
}


        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="row justify-content-center">
        <div class="col-md-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> Silahkan login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('failed') }}</strong> Silahkan login ulang.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="container text-center">
                <img src="/assets/logoku.png" alt="Welcome Image" class="img-fluid mb-3" style="max-width: 50px; width: auto; border-radius: 15px;">
                
                <h1 class="text-center">Selamat Datang</h1>

                <form action="/login" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text" id="name-addon">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" aria-describedby="name-addon">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text" id="password-addon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" aria-describedby="password-addon">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
