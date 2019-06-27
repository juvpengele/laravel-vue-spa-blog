<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostsTest extends TestCase
{

    use RefreshDatabase, WithFaker;

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
    public function test_a_blog_can_be_created_by_the_admin()
    {
        $this->withoutExceptionHandling();

        Storage::fake('avatars');

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => true,
            "cover" => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->postJson(route("api.posts.store"), $data);

        $this->assertCount(1, Post::all());

    }

    /** @test */
    public function a_post_requires_a_title_and_a_content()
    {
        Storage::fake('avatars');

        $data = [
            "title" => "",
            "content" => "",
            "category_id" => "",
            "online" => true,
            "cover" => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->postJson(route("api.posts.store"), $data);

        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function a_post_requires_a_image_as_cover()
    {
        Storage::fake('avatars');

        $data = [
            "title" => "Lorem",
            "content" => "Some content",
            "category_id" => create(Category::class)->id,
            "online" => true,
            "cover" => ""
        ];

        $this->postJson(route("api.posts.store"), $data);

        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $post = create(Post::class);

        $this->deleteJson(route("api.posts.destroy", $post));

        $this->assertCount(0, Post::all());

    }

}
