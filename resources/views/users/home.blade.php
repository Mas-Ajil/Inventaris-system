@extends('layouts.main')
@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>

  <!-- Link Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: url('/assets/bg-all.jpg') no-repeat center center fixed; /* Background image */
        background-size: cover; /* Make sure the image covers the entire background */
        color: #343a40; /* Default text color */
    }

    .hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px 40px; /* Space around the content */
        background-color: rgba(255, 255, 255, 0.85); /* Slight transparency for the white background */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Enhanced shadow */
        border-radius: 15px; /* Rounded corners */
        transition: transform 0.3s; /* Transition for scaling effect */
    }

    .hero:hover {
        transform: translateY(-5px); /* Slight lift effect on hover */
    }

    .hero-text {
        max-width: 600px; /* Limit width of text section */
    }

    .hero-text h1 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #343a40; /* Dark grey for the title */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Text shadow */
    }

    .hero-text p {
        font-size: 1.2rem;
        color: #6c757d; /* Lighter grey for description */
        margin-bottom: 30px; /* Space between paragraph and button */
    }

    .btn-custom {
        background: linear-gradient(45deg, #ff7e5f, #feb47b); /* Gradient background */
        border: none;
        color: white;
        padding: 15px 30px;
        font-size: 1rem;
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s; /* Added transform transition */
    }

    .btn-custom:hover {
        background: linear-gradient(45deg, #ff6b4d, #fea16e); /* Darker gradient on hover */
        transform: scale(1.05); /* Slightly enlarge button on hover */
    }

    .hero-image {
        max-width: 450px; /* Limit image size */
        height: auto;
        border-radius: 15px; /* Rounded corners for the image */
    }
    
  </style>
</head>
<body>

  <!-- Hero Section -->
  <header class="hero">
    <div class="hero-text">
      <h1>Welcome To <span style="color: #20c997;">Studio Equipment Borrow System</span></h1>
      <p>The Studio Equipment Borrow and Return System is a comprehensive solution designed to streamline the management of studio equipment within a creative or production facility. This system allows users to efficiently borrow and return various studio tools and devices, ensuring that all equipment is accounted for and maintained in optimal condition.</p>
      <a href="{{ route('loans') }}" class="btn btn-custom">Get Started</a>
    </div>
    <img src="{{ url('/assets/heroImage.jpg') }}" class="hero-image" alt="Hero Image"> <!-- Replace with actual image path -->
  </header>

@endsection
