@extends('layouts.header')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('body')
    <div class="container whole-container">
        @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger mt-3">
                {{ Session::get('error') }}
            </div>
        @endif

        <h2>My Bookings</h2>

        @if ($tickets && count($tickets) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Passenger Name</th>
                    <th scope="col">Passenger Email</th>
                    <th scope="col">Departure City</th>
                    <th scope="col">Arrival City</th>
                    <th scope="col">Departure Date</th>
                    <th scope="col">Arrival Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->passenger_name }}</td>
                        <td>{{ $ticket->passenger_email }}</td>
                        <td>{{ $ticket->flight->departureCity->name }}</td>
                        <td>{{ $ticket->flight->arrivalCity->name }}</td>
                        <td>{{ $ticket->flight->departure_time }}</td>
                        <td>{{ $ticket->flight->arrival_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $tickets->links() }}
        </div>
        @else
        <div class="text-center" class="no-flights-div">
            <h1 class="no-flights-h1">No Bookings</h1>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
