<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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

        $response = $this->getJson(route("api.posts.index"))
                        ->assertStatus(200);

        $this->assertCount(5, $response->json()["data"]);

    }

    /** @test */
    public function posts_are_fetched_by_pagination()
    {
        create(Post::class, [], 20);

        $response = $this->getJson(route("api.posts.index"));

        $this->assertCount(7, $response->json()["data"]);
    }


    /** @test */
    public function posts_can_be_filtered_with_popularity()
    {
        $this->withoutExceptionHandling();

        $popularPost = create(Post::class, ["visits" => 30]);
        create(Post::class, ["visits" => 0], 2);

        $response = $this->getJson("/api/posts?popular=1")->json();

        $this->assertEquals($popularPost->slug, $response["data"][0]["slug"]);
    }


    /** @test */
    public function post_can_be_searched()
    {
        $this->withoutExceptionHandling();

        create(Post::class, [], 3);
        $postToSearch = create(Post::class, ["title" => "Juvenal"]);

        $response = $this->getJson("/api/posts?search=Juvenal")->json();

        $searchedPostsTitle = collect($response['data'])->pluck("title");

        $this->assertContains($postToSearch->title, $searchedPostsTitle);
    }


    /** @test */
    public function we_can_show_a_blog_post()
    {
        $post = create(Post::class);

        $response = $this->getJson(route("posts.show", ["category" => $post->category, "post" => $post]));

        $this->assertContains($post->slug, $response->json()["data"]);
    }


    /** @test */
    public function when_a_post_is_shown_its_visits_count_is_added()
    {
        $post = create(Post::class, ["visits" => 0]);

        $this->getJson(route("posts.show", ["category" => $post->category, "post" => $post]));

        $this->assertEquals(1, $post->fresh()->visits);
    }

    /** @test */
    public function we_can_show_posts_according_to_a_category()
    {
        $category = create(Category::class);

        create(Post::class, ["category_id" => $category->id], 2);

        $response = $this->getJson(route("api.categories.posts", $category));

        $JsonResponse = $response->json();

        $this->assertCount(2, $JsonResponse["data"]);

    }


    /** @test */
    public function we_can_filter_posts_with_tags()
    {
        $taggedPosts = create(Post::class, [], 3);
        create(Post::class, [], 2);

        $tagIds = Tag::add(["php"]);

        foreach ($taggedPosts as $post) {
            $post->tags()->attach($tagIds);
        }

        $tag = Tag::first();

        $response = $this->getJson(route("api.tags.posts",  $tag))->json();

        $this->assertCount(5, Post::all());
        $this->assertCount(3, $response["data"]);

    }


}
