<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    public $timestamps = false;

    /**
     * Get monitorings of province
     */
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }
}
