<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'title'
    ];

    public $timestamps = false;

    /**
     * Get the roles users
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
