<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicatorCategory extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    public $timestamps = false;

    /**
     * indicators category has many indicators
     */
    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }
}
