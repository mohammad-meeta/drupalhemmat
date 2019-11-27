<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'title'
    ];

    public $timestamps = false;

    public function organs()
    {
        return $this->hasMany(Organ::class);
    }
}
