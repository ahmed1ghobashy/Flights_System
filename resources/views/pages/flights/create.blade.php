@extends('layouts.header')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
@section('body')
<div class="body-container">
    <div class="credentials-header">
        <span class="header-span">Add Flight</span>
    </div>
    <div class="credentials-body">
        <form action="{{ url('/flights') }}" method="POST">
            @csrf

            <label for="departure_country_id" class="label">Departure Country</label>
            <select id="departure_country_id" name="departure_country_id" class="form-select form-select-lg" aria-label="Large select example" style="border-radius: 7px !important; font-size: 16px;">
                <option selected disabled>Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('departure_country_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="departure_city_id" class="label mt-3">Departure City</label>
            <select id="departure_city_id" name="departure_city_id" class="form-select form-select-lg" aria-label="Large select example" style="border-radius: 7px !important; font-size: 16px;" disabled>
                <option selected disabled>Select City</option>
            </select>
            @error('departure_city_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="arrival_country_id" class="label mt-3">Arrival Country</label>
            <select id="arrival_country_id" name="arrival_country_id" class="form-select form-select-lg" aria-label="Large select example" style="border-radius: 7px !important; font-size: 16px;">
                <option selected disabled>Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('arrival_country_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="arrival_city_id" class="label mt-3">Arrival City</label>
            <select id="arrival_city_id" name="arrival_city_id" class="form-select form-select-lg" aria-label="Large select example" style="border-radius: 7px !important; font-size: 16px;" disabled>
                <option selected disabled>Select City</option>
            </select>
            @error('arrival_city_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="departure_time" class="label mt-3">Departure Time</label>
            <input type="datetime-local" class="form-control" id="datetime" name="departure_time" autocomplete="off">
            @error('departure_time')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="arrival_time" class="label mt-3">Arrival Time</label>
            <input type="datetime-local" class="form-control" id="datetime" name="arrival_time" autocomplete="off">
            @error('arrival_time')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="price" class="label mt-3">Price</label>
            <input id="price" name="price" type="number" class="form-control" step="0.01">
            @error('price')
              <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="available_seats" class="label mt-3">Available seats</label>
            <input id="available_seats" name="available_seats" type="number" class="form-control">
            @error('available_seats')
              <div class="text-danger">{{ $message }}</div>
            @enderror


            
            <button class="btn btn-primary submit-btn d-block mt-4" type="submit">Create Flight</button>
        </form>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger mt-3">
            {{ Session::get('error') }}
        </div>
    @endif
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departureCountrySelect = document.getElementById('departure_country_id');
        const departureCitySelect = document.getElementById('departure_city_id');
        const arrivalCountrySelect = document.getElementById('arrival_country_id');
        const arrivalCitySelect = document.getElementById('arrival_city_id');
    
        departureCountrySelect.addEventListener('change', function() {
            const countryId = this.value;
    
            if (countryId) {
                // Make a fetch request to get cities for the selected country
                fetch(`/api/getCitiesByCountry/${countryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error fetching cities: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(cities => {
                        // Clear the current options in the cities dropdown
                        departureCitySelect.innerHTML = '<option selected disabled>Select City</option>';
    
                        // Populate the cities dropdown with new options
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            departureCitySelect.appendChild(option);
                        });
    
                        // Enable the cities dropdown
                        departureCitySelect.disabled = false;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                // If no country is selected, clear and disable the city dropdown
                departureCitySelect.innerHTML = '<option selected disabled>Select City</option>';
                departureCitySelect.disabled = true;
            }
        });
    
        arrivalCountrySelect.addEventListener('change', function() {
            const countryId = this.value;
    
            if (countryId) {
                // Make a fetch request to get cities for the selected country
                fetch(`/api/getCitiesByCountry/${countryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error fetching cities: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(cities => {
                        // Clear the current options in the cities dropdown
                        arrivalCitySelect.innerHTML = '<option selected disabled>Select City</option>';
    
                        // Populate the cities dropdown with new options
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            arrivalCitySelect.appendChild(option);
                        });
    
                        // Enable the cities dropdown
                        arrivalCitySelect.disabled = false;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                // If no country is selected, clear and disable the city dropdown
                arrivalCitySelect.innerHTML = '<option selected disabled>Select City</option>';
                arrivalCitySelect.disabled = true;
            }
        });
    });
    </script>
@endsection