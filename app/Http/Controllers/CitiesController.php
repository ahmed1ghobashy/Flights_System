<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function getCitiesByCountry($countryId)
    {
        // Fetch cities where the country_id matches the provided countryId
        $cities = City::where('country_id', $countryId)->get(['id', 'name']);
        // Return the cities as JSON
        return response()->json($cities);
    }
}
