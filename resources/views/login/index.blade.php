@extends('layouts.sigin')

@section('sigin')
<style>
    body {
        background-image: url('/assets/bg-login.jpg');
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-3">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong> Silahkan login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('failed') }}</strong> Silahkan login kembali.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif



        <main class="form-signin w-100 m-auto">
            <div class="container-fluid text-center d-flex justify-content-center align-items-center" style="padding-top: 50%;">
                <i class="bi bi-person-circle display-4"></i>
            </div>
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

            <form action="/login" method="POST" class="row g-3" >
                @csrf
                <div class="col-md-12">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" >
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>


                <div class="col-md-12">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" >
                  @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="submit">Login</button>
                  </div>
              </form>
            

            
    </div>
</div>
@endsection
