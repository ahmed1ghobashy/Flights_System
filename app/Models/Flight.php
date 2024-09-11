<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['tickets'];

    protected $fillable = [
        'flight_number',
        'departure_city_id',
        'arrival_city_id',
        'departure_time',
        'arrival_time',
        'price',
        'available_seats',
    ];

    public function country()
    {
        return $this->hasOneThrough(Country::class, City::class, 'id', 'id', 'city_id', 'country_id');
    }
    public function departureCity () {
        return $this->belongsTo(City::class, 'departure_city_id');
    }
    public function arrivalCity () {
        return $this->belongsTo(City::class, 'arrival_city_id');
    }
    public function getPriceAttribute () {
        return round($this->attributes['price'], 2);
    }
    public function tickets () {
        return $this->hasMany(Ticket::class);
    }
}
