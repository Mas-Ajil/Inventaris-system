@extends('layouts.main')
@section('container')

<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'peminjaman_alat';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data dari tabel
$sql = "SELECT * FROM riwayat_peminjaman";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Riwayat Peminjaman Alat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Container -->
  <div class="container mt-5">
    <h2 class="text-center">Riwayat Peminjaman Alat</h2>

    <!-- Tabel Riwayat Peminjaman -->
    <table class="table table-striped mt-4">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Nama Alat</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Pengembalian</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $counter = 1;
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $counter++ . "</td>";
            echo "<td>" . $row['nama_alat'] . "</td>";
            echo "<td>" . $row['tanggal_peminjaman'] . "</td>";
            echo "<td>" . $row['tanggal_pengembalian'] . "</td>";
            echo "<td><span class='badge " . ($row['status'] == 'Dikembalikan' ? 'bg-success' : 'bg-warning') . "'>" . $row['status'] . "</span></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>Belum ada peminjaman alat.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Button Kembali ke Halaman Peminjaman -->
    <div class="d-flex justify-content-center mt-4">
      <a href="peminjaman.php" class="btn btn-primary">Kembali ke Halaman Peminjaman</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection


