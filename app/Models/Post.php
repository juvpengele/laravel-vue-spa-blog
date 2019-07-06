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

    /**
     * Relationship between a post with its creator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Relationship between a post with a category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship post with tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     *  Relationship between a post with comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function getDescriptionAttribute()
    {
        return substr($this->content, 0, 70) . "...";
    }

    public function scopeSearch($query, $value)
    {
        return $query->where("title", "LIKE", "%$value%");
    }

    public function getCoverAttribute()
    {
        $parts = explode("/", $this->cover_path);

        return end($parts);
    }

    public function scopeOnline($query, $condition = true)
    {
        return $query->where(["online" => $condition]);
    }

}
