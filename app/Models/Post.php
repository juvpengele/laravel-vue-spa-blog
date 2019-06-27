<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "slug", "user_id", "category_id", "cover_path", "online"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDescriptionAttribute()
    {
        return substr($this->content, 0, 70) . "...";
    }

    public function scopeSearch($query, $value)
    {
        return $query->where("title", "LIKE", "%$value%");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

}
