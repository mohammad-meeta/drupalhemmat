<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'title',
        'body'
    ];

    /**
     * Get the Article author
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articleType()
    {
        return $this->belongsTo(ArticleType::class);
    }
}
