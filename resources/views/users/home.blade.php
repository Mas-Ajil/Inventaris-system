@extends('layouts.main')
@section('container')


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
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
        max-height: 100px; /* Atur tinggi maksimal kartu */
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
        color: rgb(74, 74, 74); /* Change color to match your theme */
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

    .cards-row {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        flex-wrap: wrap; /* Allow cards to wrap onto the next line */
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
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 120px; /* Fixed height to make cards smaller */
    }

    .chart-card {
        margin-top: 20px;
        padding: 40px; /* Adjust padding as needed */
        height: calc(400px + 5px * 2);
    }

    .chart-card h3 {
        margin-bottom: 20px; /* Ensure space between title and chart */
        text-align: center;
    }

    .chart-card canvas {
        width: 100%;
        height: 400px; /* Increase height for better visibility */
    }

    @media (max-height: 800px) {
        .chart-card canvas {
            height: 300px; /* Adjust height for smaller screens */
            
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .welcome-message {
            font-size: 1.2rem; /* Adjust font size for welcome message */
        }

        .description,
        .duration-container {
            font-size: 0.8rem; /* Reduce font size for better visibility */
        }

        .chart-card {
            padding: 95px 20px; /* Decrease padding for smaller screens */
            margin-top: 20px;
        }

        .chart-card h4 {
            font-size: 1.5rem; /* Adjust title size */
        }

        .card {
            flex: 1 1 100%; /* Allow cards to take full width on small screens */
            margin: 10px 0; /* Add vertical margin between cards */
        }
    }

</style>



  <div class="container">
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
                <h5 class="card-title">Pengguna</h5>
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
                <h5 class="card-title">Status Dipinjam</h5>
                <h2>{{ $totalBorrowed }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Dipinjam</small>
            </div>
        </div>

        <!-- Total Returned -->
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Status Dikembalikan</h5>
                <h2>{{ $totalReturned }}</h2>
            </div>
            <div class="card-footer">
                <small class="text-muted">Total Dikembalikan</small>
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
                  @for($i = date('Y'); $i >= 2020; $i--)
                      <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
              <button type="submit">Tampilkan</button>
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
                    label: 'Jumlah Peminjaman Product (Status Returned)',
                    data: {!! json_encode($monthlyTransactions->values()) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Ensure the chart fills the container
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
