<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <style>
    
    .navbar {
      transition: background-color 0.5s ease;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
    }

    
    .navbar.scrolled {
      background-color: #343a40 !important; 
    }

    
    .nav-link {
      color: #343a40 !important; 
      transition: color 0.3s ease; 
    }

    .nav-link:hover {
      color: #757575 !important; 
    }

    
    .navbar .nav-link.active {
      background-color: #20c997; 
      color: white; 
      border-radius: 5px; 
    }

    
    .dropdown-menu {
      border-radius: 10px; 
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
    }

  
    .navbar.scrolled .nav-link,
    .navbar.scrolled .navbar-brand,
    .navbar.scrolled .dropdown-toggle {
      color: white !important; 
    }

    
    @media (max-width: 768px) {
      .navbar .nav-link {
        padding: 10px 15px; 
      }
    }
  </style>
</head>
<body>

 
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">Inventory</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home"><i class="bi bi-house-door-fill"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('product') ? 'active' : '' }}" href="/products"><i class="bi bi-file-earmark-plus-fill"></i> Borrowing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('status') ? 'active' : '' }}" href="{{ route('status.loans') }}"><i class="bi bi-check-circle-fill"></i> Status</a> <!-- Changed to Status -->
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}" href="/history"><i class="bi bi-clock-history"></i> History</a>
          </li>

          @auth
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"> </i>{{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/admin"><i class="bi bi-person-vcard"></i> Account</a></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Logout</button>
                </form>
              </li>
            </ul>
          </div>
          @else
          <li class="nav-item">
            <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Login</a>
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
