<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    public function setUp(): void
    {
        parent::setUp();

        $this->post = create(Post::class);
    }


    /** @test */
    public function a_post_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->post->creator);
    }

    /** @test */
    public function a_post_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->post->category);
    }

    /** @test */
    public function we_can_search_posts()
    {
        create(Post::class);
        $post = create(Post::class, ["title" => "Juvenal"]);

        $searchedPosts = Post::search("Juvenal")->get();

        $this->assertContains($post->title, $searchedPosts->pluck("title"));
    }

    /** @test */
    public function it_has_comments()
    {
        $post = create(Post::class);
        create(Comment::class, ["post_id" => $post->id], 2);

        $this->assertCount(2, $post->comments);
    }

    /** @test */
    public function it_can_be_linked_to_tags()
    {
        $tags = create(Tag::class, [],2);
        $post = create(Post::class);

        foreach ($tags as $tag) {
            DB::table("post_tag")->insert([
                "post_id" => $post->id,
                "tag_id"  => $tag->id
            ]);
        }

        $this->assertEquals(2, $post->tags()->count());
    }


}
