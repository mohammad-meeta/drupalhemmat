<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'title',
        'indicator_category_id',
        'status'
    ];

    public $timestamps = false;

    /**
     * indicator indicator category
     */
    public function indicatorCategory()
    {
        return $this->belongsTo(IndicatorCategory::class);
    }

    /**
     * Get monitorings of indicator
     */
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }
}
