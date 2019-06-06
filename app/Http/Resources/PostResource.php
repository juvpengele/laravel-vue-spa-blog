<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "slug"  => $this->slug,
            "description" => $this->description,
            "created_at" => $this->created_at->diffForHumans(),
            "category" => $this->category,
            "creator" => $this->creator,
            "cover_path" => $this->cover_path,
            "visits_count" => $this->visits
        ];
    }
}
