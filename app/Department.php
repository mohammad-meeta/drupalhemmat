<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    public $timestamps = false;

    /**
     * department has many article
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
