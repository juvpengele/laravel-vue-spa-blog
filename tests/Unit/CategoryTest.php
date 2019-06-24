<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_category_has_many_posts()
    {
        $category = create(Category::class);
        create(Post::class, ["category_id" => $category->id], 2);

        $this->assertCount(2, $category->posts);
    }

    /** @test */
    public function many_categories_can_be_registered_at_the_same_time()
    {
        Category::register(["php", "java", "html"]);

        $this->assertCount(3, Category::all());
    }

    /** @test */
    public function categories_are_registered_once()
    {
        Category::register(["php", "java", "html", "java"]);

        $this->assertCount(3, Category::all());
    }

    /** @test */
    public function existing_categories_can_not_be_registered()
    {
        create(Category::class, ["name" => "php"]);

        Category::register(["php", "java", "html", "java"]);

        $this->assertCount(3, Category::all());
    }

}
