<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getRouteKeyName()
    {
        return "slug";
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
