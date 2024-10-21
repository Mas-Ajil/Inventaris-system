<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <style>
        .navbar {
            font-family: 'Poppins', sans-serif; /* Pastikan font Poppins diterapkan di navbar */
            transition: background-color 0.5s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }

        .nav-link {
            color: #343a40 !important; 
            transition: color 0.3s ease; 
        }

        .nav-link:hover {
            color: #757575 !important; 
        }

        .nav-link.active {
            color: #20c997; /* Green color for active link text */
            font-weight: bold; /* Optional */
            border-bottom: 2px solid #20c997; /* Optional */
        }

        .dropdown-menu {
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
        }

        @media (max-width: 768px) {
            .navbar .nav-link {
                padding: 10px 15px; 
            }
        }

        .btn-secondary {
        background: linear-gradient(45deg, #32CD32, #228B22); 
        border: none;
        padding: 10px 15px;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #228B22, #006400);
        }

    </style>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            <img src="/assets/logoku.png" alt="Logo" style="height: 40px;">
        </a>        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home"><i class="bi bi-house-door-fill"></i> Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="/products"><i class="bi bi-file-earmark-plus-fill"></i> Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('status') ? 'active' : '' }}" href="{{ route('status.loans') }}"><i class="bi bi-check-circle-fill"></i> Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('history') ? 'active' : '' }}" href="/history"><i class="bi bi-clock-history"></i> Riwayat</a>
                </li>

                @auth
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"> </i>{{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/homeAdmin"><i class="bi bi-person-vcard"></i> Akun</a></li>
                        
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <li class="nav-item">
                    <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
</body>
</html>
