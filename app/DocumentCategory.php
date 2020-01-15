<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    protected $fillable = [
        'title'
    ];

    public $timestamps = false;

    /**
     * Documents category has many article
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
