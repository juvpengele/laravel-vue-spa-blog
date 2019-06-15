<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentRessource;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * Store a comment
     * @param Post $post
     * @return CommentRessource
     */
    public function store(Post $post)
    {
        $data  = request()->validate([
            "author_name" => "required|min:1",
            "author_email" => "required|email",
            "content"       => "required|min:2"
        ]);

        $comment = $post->comments()->create($data);

        return new CommentRessource($comment);
    }
}
