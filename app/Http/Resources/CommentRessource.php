<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentRessource extends JsonResource
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
            "id"          => $this->id,
            "author_name" => $this->author_name,
            "content"     => $this->content,
            "created_at"  => $this->created_at->diffForHumans(),
            "description" => $this->description
        ];
    }
}
