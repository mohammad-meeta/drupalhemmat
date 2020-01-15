<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'indicator_id',
        'province_id',
        'user_id',
        'year',
        'amount',
        'status'
    ];

    /**
     * Get the monitoring author
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * monitoring indicator
     */
    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    /**
     * monitoring province
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }



}
