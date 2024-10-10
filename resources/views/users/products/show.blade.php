@extends('layouts.main')

@section('container')


<div class="container">
    <h1>Borrowed Equipment for {{ $userName }}</h1>

   
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>

    @if($loans->isEmpty())
        <p>No loans found for this user.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Borrowed Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->product->name }}</td>
                        <td>{{ $loan->quantity }}</td>
                        <td>{{ $loan->borrowed_at }}</td>
                        <td>{{ $loan->returned_at ?? 'Not returned' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection