<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewPostsTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    public function all_posts_can_be_fetched()
    {
        create(Post::class, [], 5);

        $response = $this->getJson(route("api.posts.index"));
        $response->assertStatus(200);
        $this->assertCount(5, $response->json()["data"]);

    }
}
