<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'original_name',
        'name',
        'extension'
    ];

    /**
     * Article
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
