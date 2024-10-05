@extends('layouts.main')
@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Products</title>

  <!-- Link Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Link Bootstrap CSS -->
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
        background-color: rgba(255, 255, 255, 0.85);
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

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .product-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-top: 4px solid transparent; 
        background-image: linear-gradient(to bottom right, #ffffff 30%, #f8f9fa); 
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
       
        background: linear-gradient(45deg, #ff7e5f, #feb47b); 
        color: white; 
    }

    .product-card h2 {
        font-size: 1.5rem;
        color: inherit; 
        margin-bottom: 10px;
    }

    .product-card p {
        color: inherit;
        margin-bottom: 15px;
    }

    input[type="number"] {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        width: 100px;
        text-align: center;
        margin-bottom: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00c6ff); 
        border: none;
        color: white;
        padding: 15px 30px;
        font-size: 1rem;
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0069d9, #00aaff); 
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .product-card {
            padding: 15px;
        }

        input[type="number"] {
            width: 70px;
        }
    }
  </style>
</head>
<body>

<div class="container">
    <h1>Choose The Equipment</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <h2>{{ $product->name }}</h2>
                    <p>Stok: {{ $product->stock }}</p>
                    <input type="number" name="quantity[]" max="{{ $product->stock }}" value="0">
                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                </div>
            @endforeach
        </div>
<br>
        <div class="form-group">
            <label for="borrowed_at">Borrow Date :</label>
            <input type="date" name="borrowed_at" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="returned_at">Return Date :</label>
            <input type="date" name="returned_at" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Pinjam Produk</button>
    </form>
</div>

</body>
</html>
@endsection
