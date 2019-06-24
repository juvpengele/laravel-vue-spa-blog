<?php

namespace Tests\Feature;

use App\Models\Category;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCategoriesTest extends TestCase
{

    use RefreshDatabase;

    protected $admin;
    protected $authToken;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = create(User::class);
        $this->signIn($this->admin);
        $this->authToken = auth()->tokenById($this->admin->id);
    }


    /** @test */
    public function administrator_can_create_a_category()
    {
        $categoryAttributes = ["names" => "php,javascript,html"];

        $this->withHeaders([
            "Authorization" => "Bearer $this->authToken"
        ])->postJson(route("api.categories.store"), $categoryAttributes);

        $this->assertCount(3, Category::all());
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = create(Category::class, ["name" => "javascript"]);

        $this->withHeaders([
            "Authorization" => "Bearer $this->authToken"
        ])->putJson(route("api.categories.update", $category), ["name" => "php"]);

        $this->assertEquals("php", $category->fresh()->name);
    }

    /** @test */
    public function a_category_can_be_registered_once()
    {
        Category::register(["php", "javascript"]);

        $category = create(Category::class, ["name" => "java"]);

        $response = $this->withHeaders([
            "Authorization" => "Bearer $this->authToken"
        ])->putJson(route("api.categories.update", $category), ["name" => "php"]);

        $this->assertEquals("java", $category->fresh()->name);
        $this->assertTrue(array_key_exists("name", $response->json()["errors"]));

    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = create(Category::class, ["name" => "java"]);

        $this->withHeaders([
            "Authorization" => "Bearer $this->authToken"
        ])->deleteJson(route("api.categories.destroy", $category));

        $this->assertDatabaseMissing("categories", [
            "name" => $category->name
        ]);
    }


}
