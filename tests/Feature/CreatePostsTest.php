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

    /** @test */
    public function to_be_online_a_post_depends_on_the_online_parameter()
    {
        $this->withoutExceptionHandling();

        Storage::fake('avatars');

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => false,
            "cover" => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->postJson(route("api.posts.store"), $data);

        $this->assertCount(1, Post::online(false)->get());

        $this->deleteStoreFile(Post::all()->pluck("cover")->toArray());

    }

    /** @test */
    public function a_blog_post_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $post = create(Post::class, ["title" => "Old title", "online" => true]);

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => false,
        ];

        $this->putJson(route("api.posts.update", $post), $data);

        $post = $post->fresh();

        $this->assertEquals($data["title"], $post->title);
        $this->assertEquals($data["online"], !! $post->online);
    }


    /** @test */
    public function post_cove_images_can_be_updated()
    {
        $post = create(Post::class, ["title" => "Old title", "online" => true]);

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => false,
            "cover" => UploadedFile::fake()->image('avatar.jpg')
        ];

        $this->putJson(route("api.posts.update", $post), $data);

        $this->assertTrue($post->cover !== $post->fresh()->cover);

        $this->deleteStoreFile(Post::all()->pluck("cover")->toArray());
    }

    private function deleteStoreFile(array $filenames) : void
    {

        if(is_array($filenames)) {
            foreach ($filenames as $filename) {
                Storage::delete("public/covers/{$filename}");
            }
        } else {
            Storage::delete("public/covers/{$filenames}");
        }
    }

}
