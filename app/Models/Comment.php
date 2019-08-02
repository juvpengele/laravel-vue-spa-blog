<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["author_name", "author_email", "content"];
    protected $appends = ["description"];


    /**
     * Getters for the content description attribute
     * @return string
     */
    public function getDescriptionAttribute() : string
    {
        return substr($this->attributes["content"], 0, 30) . "...";
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
