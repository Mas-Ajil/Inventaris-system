@extends('layouts.sigin')

@section('sigin')


<div class="row justify-content-center" >
    <div class="col-md-3">
        <main class="form-registrations w-100 m-auto">
            <div class="container-fluid text-center d-flex justify-content-center align-items-center " style="padding-top: 50%; ">
                <i class="bi bi-person-circle display-4"></i>
            </div>
            <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

            <form action="/register" method="POST" class="row g-3" >
                @csrf
                <div class="col-md-12">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" >
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email"  >
                    @error('email')
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
                    <button class="btn btn-primary" type="submit">Register</button>
                  </div>
              </form>

            <small class="d-block text-center mt-3">Already have an account? <a href="/login">Login Now!</a></small>
        </main>
    </div>
</div>



@endsection