<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'document_category_id',
        'department_id',
        'title',
        'body',
        'status'
    ];

    /**
     * Get the Article author
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Article type
     */
    public function type()
    {
        return $this->belongsTo(ArticleType::class);
    }

    /**
     * Article document category
     */
    public function documentCategory()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    /**
     * Article department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * files
     */
    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    /**
     * Add an attachment to this article
     */
    public function addAttachment($file)
    {
        $fileName = $file->store('public/files');
        $ext = $file->getClientOriginalExtension();

        /* New file */
        $newFile = File::create([
            "original_name" => $file->getClientOriginalName(),
            "name" => $fileName,
            "extension" => $ext
        ]);

        $this->files()->attach($newFile->id);

        return $newFile;
    }
}
