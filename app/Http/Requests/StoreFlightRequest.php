<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
{
    public function authorize()
    {
        // Set to true if the request should be authorized, false otherwise
        return true;
    }

    public function rules()
    {
        return [
            'departure_country_id' => 'required|exists:countries,id',
            'departure_city_id' => 'required|exists:cities,id',
            'arrival_country_id' => 'required|exists:countries,id',
            'arrival_city_id' => 'required|exists:cities,id',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:100',
            'available_seats' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'arrival_city_id.required' => 'Arrival city is required.',
            'arrival_city_id.exists' => 'Selected arrival city does not exist.',
            'arrival_city_id.not_in' => 'Arrival city must be different from departure city.',
            'arrival_time.after' => 'Arrival time must be after departure time.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'departure_city_id' => $this->input('departure_city_id'),
            'arrival_city_id' => $this->input('arrival_city_id'),
        ]);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->departure_city_id === $this->arrival_city_id) {
                $validator->errors()->add('arrival_city_id', 'Arrival city must be different from departure city.');
            }
        });
    }
}
