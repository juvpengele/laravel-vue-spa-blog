<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Tag extends Model
{
    public $fillable = ["name", "slug"];

    public function getRouteKeyName()
    {
        return "slug";
    }

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
     * @return Collection
     */
    public static function add(array $tagNames) : Collection
    {
        $tagNames = array_unique($tagNames);

        $tagToInsert = static::getTagToInsert($tagNames);

        static::addMany($tagToInsert);

        return static::whereIn("name", $tagNames)->pluck("id");
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
