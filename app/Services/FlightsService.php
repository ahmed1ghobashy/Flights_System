<?php

namespace App\Services;

use App\Models\Flight;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class FlightsService {
    public function getIndexData () {
        $flights = Flight::where('available_seats' , '>',  0)
        ->with('departureCity')
        ->with('arrivalCity')
        ->paginate(10);

        $countries = Country::with('cities')->get();

        return ['flights' => $flights, 'countries' => $countries];
    }

    public function storeFlight ($request) {
        $flight_number = Str::random(32);
        $flight = Flight::create([
            'flight_number' => $flight_number,
            'departure_city_id' => $request->departure_city_id,
            'arrival_city_id' => $request->arrival_city_id,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price,
            'available_seats' => $request->available_seats,
        ]);
        Session::flash('success', "Flight Created Successfully");
        return $flight;
    }

    public function deleteFlight ($id) {
        $flight = Flight::find($id);
        
        if (!$flight) {
            Session::flash('error', 'Flight Not Found');
            return false;
        }

        if (!$flight->delete()) {
            Session::flash('error', 'Something Went Wrong');
            return false;
        }
        Session::flash('success', 'Flight Deleted Successfully');
        return true;
    }

    public function getFlightEditData($id) {
        $flight = Flight::where('id', $id)
        ->with(['departureCity' => function ($query) {
            $query->with('country');
        }])
        ->with(['arrivalCity' => function ($query) {
            $query->with('country');
        }])
        ->first();
        
        if (!$flight) {
            Session::flash('error', 'Flight Not Found');
            return false;
        }
        $countries = Country::all();
        return ['flight' => $flight, 'countries' => $countries];
    }

    public function updateFlight ($request, $id) {
        $flight = Flight::find($id);

        if (!$flight) {
            Session::flash('error', 'No Flight Found');
            return false;
        }
        $flight->departure_city_id = $request->departure_city_id;
        $flight->arrival_city_id = $request->arrival_city_id;
        $flight->departure_time = $request->departure_time;
        $flight->arrival_time = $request->arrival_time;
        $flight->price = $request->price;
        $flight->available_seats = $request->available_seats;
        
        if (!$flight->save()) {
            Session::flash('error', 'Something Went Wrong');
            return false;
        }
        Session::flash('success', 'Flight Updated Successfully');
        return true;
    }

    public function flightSearch ($request) {
        $flights = Flight::when($request->departure_country_id != null, function ($query) use ($request) {
            $query->whereHas('departureCity', function ($query) use ($request) {
                $query->where('country_id', $request->departure_country_id);
            });
        })
        ->when($request->departure_city_id != null, function ($query) use ($request) {
            $query->where('departure_city_id', $request->departure_city_id);
        })
        ->when($request->arrival_country_id != null, function ($query) use ($request) {
            $query->whereHas('arrivalCity', function ($query) use ($request) {
                $query->where('country_id', $request->arrival_country_id);
            });
        })
        ->when($request->arrival_city_id != null, function ($query) use ($request) {
            $query->where('arrival_city_id', $request->arrival_city_id);
        })
        ->when($request->departure_date, function ($query) use ($request) {
            $date = Carbon::parse($request->departure_date)->subDay();
            $query->whereDate('departure_time', '=', $date);
        })
        ->with('departureCity')
        ->with('arrivalCity')
        ->paginate(10)
        ->appends($request->query());
        $countries = Country::with('cities')->get();
        return [
            'flights' => $flights,
            'countries' => $countries,
        ];
    }

}