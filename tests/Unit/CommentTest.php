<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_belongs_to_a_post()
    {
        $post = create(Post::class);
        $comment = create(Comment::class, ['post_id' => $post->id]);

        $this->assertEquals($post->id, $comment->post->id);
    }
}
