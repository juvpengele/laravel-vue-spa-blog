<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
    public function a_tag_can_be_linked_to_many_posts()
    {
        $tag = create(Tag::class);
        $posts = create(Post::class, [], 2);

        foreach ($posts as $post) {
            DB::table("post_tag")->insert([
                "post_id" => $post->id,
                "tag_id"  => $tag->id
            ]);
        }

        $this->assertEquals(2, $tag->posts()->count());

    }
}
