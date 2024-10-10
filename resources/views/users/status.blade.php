@extends('layouts.main')
@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrowed Equipment</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #343a40;
    }

    .container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
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
        }
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Borrowed Equipment</h1>
    
        @if($loans->isEmpty())
            <p>You haven't borrowed any equipment yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Giver</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $previousUser = null;
                    @endphp
                    @foreach($loans as $loan)
                        @if($loan->status === 'borrowed' && $loan->user_name !== $previousUser)
                            <tr>
                                <td>{{ $loan->user_name }}</td>
                                <td>{{ $loan->user->name }}</td>
                                <td>{{ $loan->borrowed_at }}</td>
                                <td>{{ $loan->returned_at ?? 'Not returned' }}</td>
                                <td>
                                    <a href="/status/{{ $loan->user_name }}" class="more-button">More</a>
                
                                        <form action="{{ route('loan.return', $loan->user_name) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="return-button">Return</button>
                                        </form>
                                        
                                    
                                </td>
                            </tr>
                            @php
                                $previousUser = $loan->user_name; 
                            @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</body>
</html>

@endsection
