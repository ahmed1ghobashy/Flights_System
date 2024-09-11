<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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
}
