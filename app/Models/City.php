<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = [];
    protected $fillable = [
        'name',
        'country_id',
    ];
    public function country () {
        return $this->belongsTo(Country::class);
    }
    public function flights () {
        return $this->hasMany(Flight::class);
    }
}
