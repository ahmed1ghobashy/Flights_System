<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = [];

    protected $fillable = [
        'ticket_number',
        'passenger_name',
        'passenger_email',
        'passenger_phone_number',
        'user_id',
        'flight_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
    public function flight () {
        return $this->belongsTo(Flight::class);
    }
}
