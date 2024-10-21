@extends('layouts.main')
@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
    }

    .welcome-message {
        text-align: center;
        margin: -8px 0;
        color: #000000;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .description {
        text-align: center;
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .chart-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    height: calc(100vh - 200px); /* Menyesuaikan tinggi */
    }

    .cards-column {
        flex: 0 0 33%; /* Lebar kolom kartu sekitar 33% dari container */
    }

    .chart-card {
        flex: 1;
        margin-left: 10px; /* Jarak antara kolom kartu dan grafik */
    }

    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    /* Menambahkan jarak antar kartu dan margin bawah */
    .col-md-6 {
        padding-right: 10px;
        padding-left: 10px;
    }

    /* Ensure the card heights are consistent */
    .card-body {
        height: 100%;
    }
    
  </style>
</head>
<body>

  <div class="container">
    <!-- Welcome Message Card -->
    <div class="card mb-3 welcome-card">
      <div class="card-body text-center">
        <h5 class="welcome-message">
          <i class="bi bi-person-fill"></i>
          Hai, <span style="color: #20c997;">{{ Auth::user()->name }}!</span>
        </h5>      
    
      </div>
    </div>

    
    <div class="row chart-container">
      <!-- Cards Section -->
      <div class="col-md-4 cards-column">
          <div class="row">
              <!-- Total Users -->
              <div class="col-md-6 mb-3">
                  <div class="card text-center">
                      <div class="card-body">
                          <h5 class="card-title">Pengguna</h5>
                          <h2>{{ $totalUsers }}</h2>
                      </div>
                      <div class="card-footer">
                          <small class="text-muted">Total Pengguna</small>
                      </div>
                  </div>
              </div>
    
              <!-- Total Peminjam Bulan Ini -->
              <div class="col-md-6 mb-3">
                  <div class="card text-center">
                      <div class="card-body">
                          <h5 class="card-title">Peminjam Bulan Ini</h5>
                          <h2>{{ $totalPeminjamBulanIni }}</h2>
                      </div>
                      <div class="card-footer">
                          <small class="text-muted">Total Peminjam</small>
                      </div>
                  </div>
              </div>
    
              <!-- Total Borrowed -->
              <div class="col-md-6 mb-3">
                  <div class="card text-center">
                      <div class="card-body">
                          <h5 class="card-title">Status Dipinjam</h5>
                          <h2>{{ $totalBorrowed }}</h2>
                      </div>
                      <div class="card-footer">
                          <small class="text-muted">Total Dipinjam</small>
                      </div>
                  </div>
              </div>
    
              <!-- Total Returned -->
              <div class="col-md-6 mb-3">
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
          </div>
      </div>
    
      <!-- Chart Section -->
      <div class="col-md-8 chart-card">
          <div class="card">
              <div class="card-body">
                <h3 style="text-align: center;">Grafik Transaksi Selesai Th. {{ $year }}</h3>
                  <canvas id="returnedTransactionChart"></canvas>
                  <form method="GET" action="{{ route('transactions.chart') }}">
                      <label for="year">Tahun</label>
                      <select name="year" id="year">
                          @for($i = date('Y'); $i >= 2020; $i--)
                              <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                      </select>
                      <button type="submit">Submit</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    </div>
  </div>

  <script>
      // Grafik batang (bar) untuk transaksi returned
      var ctx1 = document.getElementById('returnedTransactionChart').getContext('2d');
      var returnedTransactionChart = new Chart(ctx1, {
          type: 'bar',
          data: {
              labels: {!! json_encode($monthlyTransactions->keys()) !!}, // Nama bulan
              datasets: [{
                  label: 'Jumlah Peminjaman Product (Status Returned)',
                  data: {!! json_encode($monthlyTransactions->values()) !!}, // Jumlah per bulan
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>

@endsection
