<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['cities'];
    protected $fillable = [
        'name'
    ];
    public function cities () {
        return $this->hasMany(City::class);
    }
    public function flights()
    {
        return $this->hasManyThrough(Flight::class, City::class);
    }
}
