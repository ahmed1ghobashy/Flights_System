<?php

namespace App\Services;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;

class TicketsService {
    public function getIndexData () {
        $tickets = Auth::user()
        ->tickets()
        ->with(['flight' => function ($query) {
            $query->with(['departureCity', 'arrivalCity']);
        }])
        ->paginate(10);

        return $tickets;
    }

    public function store ($request) {
        $ticket_number = 'ticket_' . Auth::user()->id . '_' . Str::random(32);
        $ticket = Ticket::create([
            'ticket_number' => $ticket_number,
            'passenger_name' => $request->passenger_name,
            'passenger_email' => $request->passenger_email,
            'passenger_phone_number' => $request->passenger_phone_number,
            'user_id' => Auth::user()->id,
            'flight_id' => $request->flight_id
        ]);

        $flight = $ticket->flight;
        $flight->available_seats -= 1;
        $flight->save();
        Session::flash('success', "Flight Booked Successfully");
    }
}