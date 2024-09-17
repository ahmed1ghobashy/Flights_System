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
        <form action="{{ url('/flight/search') }}" method="GET">
            <div class="search-container d-flex">
                <div class="search-flights-div">
                    <label for="departure_country">Departure Country</label>
                    <select class="form-select" id="departure_country" name="departure_country_id"
                        aria-label="Default select example">
                        <option selected value="">All</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-flights-div">
                    <label for="departure_city">Departure City</label>
                    <select class="form-select" id="departure_city" name="departure_city_id"
                        aria-label="Default select example" disabled>
                        <option selected value="">All</option>
                    </select>
                </div>

                <div class="search-flights-div">
                    <label for="arrival_country">Arrival Country</label>
                    <select class="form-select" id="arrival_country" name="arrival_country_id"
                        aria-label="Default select example">
                        <option selected value="">All</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-flights-div">
                    <label for="arrival_city">Arrival City</label>
                    <select class="form-select" id="arrival_city" name="arrival_city_id" aria-label="Default select example"
                        disabled>
                        <option selected value="">All</option>
                    </select>
                </div>

                <div class="search-flights-div">
                    <label for="departure_date">Departure Date</label>
                    <input type="date" class="form-control" name="departure_date" id="departure_date">
                </div>

                <div class="search-flights-div search-btn-div">
                    <label class="d-block search-btn-label">&nbsp;</label>
                    <button class="d-block btn btn-primary search-btn" type="submit">Search</button>
                </div>
            </div>
        </form>

        @if (isset($flights) && count($flights) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Departure City</th>
                    <th scope="col">Arrival City</th>
                    <th scope="col">Departure Time</th>
                    <th scope="col">Arrival Time</th>
                    <th scope="col">Price</th>
                    <th scope="col">Available Seats</th>
                    <th scope="col">Booking</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <td>{{ $flight->departureCity->name }}</td>
                        <td>{{ $flight->arrivalCity->name }}</td>
                        <td>{{ $flight->departure_time }}</td>
                        <td>{{ $flight->arrival_time }}</td>
                        <td>{{ $flight->price }}$</td>
                        <td>{{ $flight->available_seats }}</td>
                        <td>
                            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="{{ '#modal' . $flight->id }}">
                                Book
                            </button>

                            <div class="modal fade" id="{{ 'modal' . $flight->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ url('tickets') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Book Ticket</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="flight_id" value="{{ $flight->id }}">

                                                <label for="passenger_name">Passenger Name</label>
                                                <input class="form-control" type="text" id="passenger_name" name="passenger_name" placeholder="Enter the name" required>
                                                
                                                <label for="passenger_email">Passenger Email</label>
                                                <input class="form-control" type="email" id="passenger_email" name="passenger_email" placeholder="Enter the email" required>
                                                
                                                <label for="passenger_phone_number">Passenger Phone Number</label>
                                                <input class="form-control" type="text" id="passenger_phone_number" name="passenger_phone_number" placeholder="Enter the phone number" required>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="{{ url('flights/' . $flight->id . '/edit/') }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('flights/' . $flight->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $flights->links() }}
        </div>
        @else
        <div class="text-center" class="no-flights-div">
            <h1 class="no-flights-h1">No Flights</h1>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function getCiteis(countryId, citySelectId) {
            let cities = @json($countries->pluck('cities', 'id'));
            const citySelect = document.getElementById(citySelectId);

            citySelect.innerHTML = '<option value="">All</option>';

            if (cities[countryId]) {
                cities[countryId].forEach(function(city) {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.text = city.name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
            }
        }

        document.getElementById('departure_country').addEventListener('change', function() {
            const countryId = this.value;
            getCiteis(countryId, 'departure_city');
        });

        document.getElementById('arrival_country').addEventListener('change', function() {
            const countryId = this.value;
            getCiteis(countryId, 'arrival_city');
        });
    </script>
@endsection
