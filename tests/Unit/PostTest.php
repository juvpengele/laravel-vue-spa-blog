<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\User;
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


}
