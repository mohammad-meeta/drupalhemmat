<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    protected $fillable = [
        'title',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
