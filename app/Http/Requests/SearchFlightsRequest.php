<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchFlightsRequest extends FormRequest
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
            'departure_country_id' => 'nullable|exists:countries,id',
            'departure_city_id' => 'nullable|exists:cities,id',
            'arrival_country_id' => 'nullable|exists:countries,id',
            'arrival_city_id' => 'nullable|exists:cities,id',
        ];
    }
}
