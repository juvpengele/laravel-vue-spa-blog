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
}
