<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFlightsRequest;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use Illuminate\Http\Request;
use Auth;
use App\Models\Flight;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Services\FlightsService;

class FlightController extends Controller
{
    protected $flightsService;
    public function __construct(FlightsService $flightsService) {
        $this->flightsService = $flightsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indexData = $this->flightsService->getIndexData();

        return view('pages.flights.index', [
            'flights' => $indexData['flights'],
            'countries' => $indexData['countries'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('pages.flights.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlightRequest $request)
    {
        $this->flightsService->storeFlight($request);
        return redirect('/flights');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->flightsService->getFlightEditData($id);
        if (!$data['flight']) {
            return redirect()->back();
        }
        return view('pages.flights.edit', [
            'flight' => $data['flight'],
            'countries' => $data['countries'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlightRequest $request, string $id)
    {
        if (!$this->flightsService->updateFlight($request, $id)) {
            return redirect()->back();
        }
        return redirect('flights');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->flightsService->deleteFlight($id);
        return redirect()->back();
    }

    public function search(SearchFlightsRequest $request)
    {
        $flightsData = $this->flightsService->flightSearch($request);
        return view('pages.flights.index', [
            'flights' => $flightsData['flights'],
            'countries' => $flightsData['countries'],
        ]);
    }

}
