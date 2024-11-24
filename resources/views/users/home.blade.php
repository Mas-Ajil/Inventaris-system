@extends('layouts.main')
@section('container')


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
    }
    .container-home{
        margin-left: 30px;
        margin-right: 30px;
    }

    .welcome-message {
        text-align: center;
        margin: -7px 0;
        color: #000000;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .welcome-card {
        min-height: 100px;
        max-height: 100px;
    }

    .description {
        text-align: center;
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .duration-container {
        text-align: center;
        margin-top: 4px;
        font-size: 1.0rem;
        font-weight: 400;
        color: rgb(74, 74, 74); 
        font-family: 'Montserrat', sans-serif;
    }

    .duration-item {
        display: inline-block;
        margin: 0 10px;
        padding: 10px 15px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .duration-item:hover {
        transform: scale(1.1);
    }

    .chart-container {
        margin-top: 20px;
    }

    .btn-primary {
<<<<<<< HEAD
        background: linear-gradient(45deg, #32CD32, #228B22); 
=======
        background: linear-gradient(45deg, #007bff, #00c6ff); 
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7
        border: none;
        color: white;
        padding: 4px 10px;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #0081c9); 
        transform: scale(1.05);
    }

    .cards-row {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        margin: 0 10px;
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 120px;
    }

    .chart-card {
        margin-top: 20px;
        padding: 40px;
        height: calc(400px + 5px * 2);
    }

    .chart-card h3 {
        margin-bottom: 20px;
        text-align: center;
    }

    .chart-card canvas {
        width: 100%;
        height: 400px;
    }

    @media (max-height: 800px) {
        .chart-card canvas {
            height: 300px;
            
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .welcome-message {
            font-size: 1.2rem;
        }

        .description,
        .duration-container {
            font-size: 0.8rem; 
        }

        .chart-card {
            padding: 95px 20px; 
            margin-top: 20px;
        }

        .chart-card h4 {
            font-size: 1.5rem;
        }

        .card {
            flex: 1 1 100%;
            margin: 10px 0; 
        }
    }

</style>



  <div class="container-home">
    <!-- Welcome Message Card -->
    <div class="card mb-3 welcome-card">
        <div class="card-body text-center">
            <h5 class="welcome-message">
                <i class="bi bi-person-fill"></i>
                @if(Auth::user()->full_name)
                    Hai, <span style="color: #20c997;">{{ Auth::user()->full_name }}!</span>
                @else
                    <span style="color: #dc3545;">Isikan Nama Lengkap Anda!</span>
                @endif
            </h5>
            <h6 id="current-date-time" class="clock-card"></h6>
            <div class="duration-container">
                Durasi Login: <span id="login-duration"></span>
            </div>
        </div>
    </div>
   
    <!-- Cards Section -->
    <div class="cards-row">
        <!-- Total Users -->
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Pengguna Aktif</h5>
                <h2>{{ $totalUsers }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Pengguna</small>
            </div>
        </div>

        <!-- Total Peminjam Bulan Ini -->
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Bulan Ini</h5>
                <h2>{{ $totalPeminjamBulanIni }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Peminjam</small>
            </div>
        </div>

        <!-- Total Borrowed -->
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Dalam Proses</h5>
                <h2>{{ $totalBorrowed }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Proses</small>
            </div>
        </div>

        <!-- Total Returned -->
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Selesai</h5>
                <h2>{{ $totalReturned }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Selesai</small>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="card chart-card">
        <div class="card-body">
          <h4>Grafik Transaksi Selesai Th. {{ $year }}</h4>
          <canvas id="returnedTransactionChart"></canvas>
          <form method="GET" action="{{ route('transactions.chart') }}">
              <label for="year">Tahun</label>
              <select name="year" id="year">
                  @for($i = date('Y'); $i >= 2023; $i--)
                      <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
              <button class="btn btn-primary" type="submit">Tampilkan</button>
          </form>
        </div>
    </div>
  </div>

  <script>
        //Grafik Chart
        var ctx1 = document.getElementById('returnedTransactionChart').getContext('2d');
        var returnedTransactionChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyTransactions->keys()) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman Barang (Status Selesai)',
                    data: {!! json_encode($monthlyTransactions->values()) !!},
                    backgroundColor: 'rgba(50, 205, 50, 0.7)',
                    borderColor: 'rgba(34, 139, 34, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        
      // Menghitung durasi login
      if (!sessionStorage.getItem('loginTime')) {
        sessionStorage.setItem('loginTime', new Date());
      }

      var loginTime = new Date(sessionStorage.getItem('loginTime'));

      function updateLoginDuration() {
        var now = new Date();
        var duration = now - loginTime;

        var hours = Math.floor(duration / (1000 * 60 * 60));
        var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((duration % (1000 * 60)) / 1000);

        var formattedDuration = hours + " jam " + minutes + " menit " + seconds + " detik";
        document.getElementById('login-duration').innerHTML = formattedDuration;
      }

      setInterval(updateLoginDuration, 1000);
      updateLoginDuration();
  </script>

@endsection
