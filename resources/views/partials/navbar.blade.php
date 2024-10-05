<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .navbar {
      transition: background-color 0.5s ease, color 0.5s ease; /* Transisi yang halus */
    }

    /* Kelas untuk navbar ketika di-scroll */
    .navbar.scrolled {
      background-color: #343a40 !important; /* Warna gelap untuk navbar */
      transition: background-color 0.3s ease;
    }

    /* Teks navbar saat di-scroll */
    .navbar.scrolled .nav-link,
    .navbar.scrolled .navbar-brand,
    .navbar.scrolled .dropdown-toggle {
      color: white !important; /* Ubah teks menjadi putih */
    }

    .navbar .nav-link,
    .navbar .navbar-brand,
    .navbar .dropdown-toggle {
      transition: color 0.5s ease; /* Transisi halus pada teks */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">MyApp</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/loans">Peminjaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/my-loans">Pengembalian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/riwayat">Riwayat</a>
          </li>

          @auth
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome back, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/home"><i class="bi bi-person-vcard"></i> Account</a></li>
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

  <!-- Link Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // JavaScript untuk mendeteksi scroll dan mengubah navbar
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
