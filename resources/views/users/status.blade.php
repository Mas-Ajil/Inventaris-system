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
        overflow-x: hidden; /* Prevent horizontal scroll on body */
    }

    .container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #20c997; 
        text-align: center;
        margin-bottom: 40px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .return-button {
        background: linear-gradient(45deg, #ff7e5f, #feb47b); 
        border: none;
        color: white;
        padding: 5px 10px; 
        font-size: 1rem; 
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s;
        text-decoration: none; 
        text-align: center; 
    }

    .more-button {
        background: linear-gradient(45deg, #007bff, #00c6ff); 
        border: none;
        color: white;
        padding: 5px 10px; 
        font-size: 1rem; 
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s;
        text-decoration: none; 
        text-align: center;
    }

    .return-button:hover {
        background: linear-gradient(45deg, #ff6b4d, #fea16e); 
        transform: scale(1.05);
    }

    .more-button:hover {
        background: linear-gradient(45deg, #0056b3, #00aaff); 
        transform: scale(1.05); 
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #343a40;
    }

    td {
        font-size: 1rem;
        color: #6c757d;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .table {
        margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        table, th, td {
            font-size: 0.9rem;
        }

        .return-button, .more-button {
            padding: 8px 15px;
            font-size: 0.9rem;
            margin: 10px 0;
        }

        /* Ensure the table is scrollable on small screens */
        .table-responsive {
            overflow-x: auto;
        }
    }
  </style>

   <div class="">
    <h1>List Peminjaman</h1>

    @if($transactions->isEmpty())
        <p>Belum ada peminjaman sama sekali.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Pemberi</th>
                    <th>Tanggal Pinjam</th>
                    <th>Estimasi Kembali</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction) 
                    @php
                        // Mengambil data pinjaman pertama untuk ditampilkan
                        $firstLoan = $transaction->loans->first(); 
                    @endphp
                    <tr>
                        <td>{{ $firstLoan->user_name }}</td> 
                        <td>{{ $transaction->user->full_name }}</td> 
                        <td>{{ \Carbon\Carbon::parse($firstLoan->borrowed_at)->format('d-m-Y') }}</td>
                        <td>
                            @if($firstLoan->returned_at)
                            {{ \Carbon\Carbon::parse($firstLoan->returned_at)->format('d-m-Y') }} ({{ \Carbon\Carbon::parse($firstLoan->borrowed_at)->diffInDays(\Carbon\Carbon::parse($firstLoan->returned_at)) }} hari)
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('loan.show', $transaction->id) }}" class="more-button">More</a>
                            
                           
                            <form action="{{ route('loan.return', $transaction->id) }}" method="POST" style="display:inline;" id="returnForm-{{ $transaction->id }}">
                                @csrf
                                <button type="button" class="return-button" onclick="confirmReturn({{ $transaction->id }})">Return</button>
                            </form>
                                <script>
                                    function confirmReturn(transactionId) {
                                        Swal.fire({
                                            title: "Apakah Kamu ingin mengembalikan?",
                                            text: "Jika kamu yakin klik tombol dibawah ini!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Yes, Return!"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Submit the form if confirmed
                                                document.getElementById('returnForm-' + transactionId).submit();
                                                Swal.fire({
                                                        title: "Returned!",
                                                        text: "Barang sudah dikembalikan",
                                                        icon: "success"
                                                        });
                                            }
                                        });
                                    }

                                                Swal.fire({
                                            title: "Do you want to save the changes?",
                                            showDenyButton: true,
                                            showCancelButton: true,
                                            confirmButtonText: "Save",
                                            denyButtonText: `Don't save`
                                            }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                Swal.fire("Saved!", "", "success");
                                            } else if (result.isDenied) {
                                                Swal.fire("Changes are not saved", "", "info");
                                            }
                                            });
                                    </script>
                                    
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


@endsection
