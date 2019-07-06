<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    public $fillable = ["name", "slug"];

    /**
     * Relationship between a tag with posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Add tags
     * @param array $tagNames
     */
    public static function add(array $tagNames) : void
    {
        $tagNames = array_unique($tagNames);

        $tagToInsert = static::getTagToInsert($tagNames);

        static::addMany($tagToInsert);
    }

    /**
     * Filter existing tags to add tags that have not been created yet
     * @param array $tagNames
     * @return array
     */
    private static function getTagToInsert(array $tagNames)
    {
        $existingTags = static::whereIn("name", $tagNames)->pluck("name");

        return array_filter($tagNames, function ($name) use ($existingTags) {
            return ! $existingTags->contains($name) && $name !== "";
        });
    }

    /**
     * Add many tags at once
     * @param array $tags
     */
    private static function addMany(array $tags) : void
    {
        $tagsToInsert = array_map(function($name) {
            return [
                "name" => $name,
                "slug" => Str::slug($name)
            ];
        }, $tags);

        static::insert($tagsToInsert);
    }

}
