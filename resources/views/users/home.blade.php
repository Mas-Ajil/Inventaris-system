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

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed; 
        background-size: cover; 
        color: #343a40;
    }

    .hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px 40px; 
        background-color: rgba(255, 255, 255, 0.85); 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
        border-radius: 15px; 
        transition: transform 0.3s; 
    }

    .hero:hover {
        transform: translateY(-5px); 
    }

    .hero-text {
        max-width: 600px; 
    }

    .hero-text h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #343a40; 
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); 
    }

    .hero-text p {
        font-size: 1.2rem;
        color: #6c757d; 
        margin-bottom: 30px; 
    }

    .btn-custom {
        background: linear-gradient(45deg, #007bff, #00c6ff); 
        border: none;
        color: white;
        padding: 15px 30px;
        font-size: 1rem;
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s; 
    }

    .btn-custom:hover {
        background: linear-gradient(45deg, #0056b3, #00aaff); 
        transform: scale(1.05); 
        color: white; 
    }

    .hero-image {
        max-width: 450px;
        height: auto;
        border-radius: 15px; 
    }
    
  </style>
</head>
<body>

  <!-- Hero Section -->
  <header class="hero">
    <div class="hero-text">
      <h1>Welcome To <span style="color: #20c997;">Studio Equipment Borrow System</span></h1>
      <p>The Studio Equipment Borrow and Return System is a comprehensive solution designed to streamline the management of studio equipment within a creative or production facility. This system allows users to efficiently borrow and return various studio tools and devices, ensuring that all equipment is accounted for and maintained in optimal condition.</p>
      <a href="{{ route('products.index') }}" class="btn btn-custom">Get Started</a>
    </div>
    <img src="{{ url('/assets/heroImage.jpg') }}" class="hero-image" alt="Hero Image"> 
  </header>

@endsection
