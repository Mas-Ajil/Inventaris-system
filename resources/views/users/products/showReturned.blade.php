@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Loan Details for {{ $loanDetails->user_name }}</h1>

    <table class="table">
        <tr>
            <th>Peminjam</th>
            <td>{{ $loanDetails->user_name }}</td>
        </tr>
        <tr>
            <th>Giver</th>
            <td>{{ $loanDetails->user->name }}</td>
        </tr>
        <tr>
            <th>Product Name</th>
            <td>{{ $loanDetails->product->name }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $loanDetails->quantity }}</td>
        </tr>
        <tr>
            <th>Borrowed Date</th>
            <td>{{ $loanDetails->borrowed_at }}</td>
        </tr>
        <tr>
            <th>Return Date</th>
            <td>{{ $loanDetails->returned_at ?? 'Not returned' }}</td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{{ $loanDetails->notes ?? 'No notes available' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $loanDetails->status }}</td>
        </tr>
    </table>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
</div>
@endsection
