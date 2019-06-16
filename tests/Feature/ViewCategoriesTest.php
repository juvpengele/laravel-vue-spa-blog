<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function categories_can_be_fetched()
    {
        create(Category::class, [], 2);

        $response = $this->getJson(route("api.categories.index"));

        $JsonResponse = $response->json();

        $this->assertCount(2, $JsonResponse["data"]);
    }

    /** @test */
    public function a_category_gives_its_number_of_posts()
    {
        $category = create(Category::class);

        create(Post::class, ["category_id" => $category->id], 2);

        $response = $this->getJson(route("api.categories.index"));

        $data = $response->json()["data"];

        $this->assertEquals(2, $data[0]["posts_count"]);
    }

}
