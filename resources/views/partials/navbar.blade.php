<div class="wrapper d-flex align-items-stretch">
    <!-- Sidebar -->
    <nav id="sidebar" class="">
        <!-- Logo di tengah -->
        <div class="logo-container">
            <a href="/home" class="logo">
                <img src="/assets/logoku.png" alt="Logo">
            </a>
        </div>

        <!-- Menu List -->
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="/home">
                    <span class="fa fa-home"></span> 
                    <span class="sidebar-text">Beranda</span>
                </a>
            </li>
            
            @if (auth()->user()->level=="superAdmin")
            <li>
                <a href="/listUser">
                    <span class="fa fa-database"></span> 
                    <span class="sidebar-text">User</span>
                </a>
            </li>
            @endif
            <li>
                <a href="/listProduct">
                    <span class="bi bi-box"></span> 
                    <span class="sidebar-text">Barang</span>
                </a>
            </li>
            <li>
                <a href="/products">
                    <span class="bi bi-file-earmark-plus-fill"></span> 
                    <span class="sidebar-text">Pinjam</span>
                </a>
            </li>
            <li>
                <a href="{{ route('status.loans') }}">
                    <span class="bi bi-check-circle-fill"></span> 
                    <span class="sidebar-text">Status</span>
                </a>
            </li>
            <li>
                <a href="/history">
                    <span class="bi bi-clock-history"></span> 
                    <span class="sidebar-text">Riwayat</span>
                </a>
            </li>
        </ul>

        <!-- Profil di bagian bawah dengan dropup -->
        <div class="profile-section">
            <div class="profile-dropup dropup">
                <button class="btn dropdown-toggle" type="button" id="profileDropup" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-square"></i>
                    <span class="sidebar-text">{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="profileDropup">
                    <li><a class="dropdown-item" href="/homeAdmin"><i class="fa fa-user"></i> Profile</a></li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fa fa-sign-out-alt"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div id="content" class="p-4 p-md-3">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
        </nav>

        <div class="container mt-4">
            @yield('container')
        </div>
    </div>
</div>


