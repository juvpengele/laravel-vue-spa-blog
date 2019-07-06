<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
            "cover" => UploadedFile::fake()->image('avatar.jpg'),
            "tags" =>"php,java,javascript"
        ];

        $this->postJson(route("api.posts.store"), $data);

        $this->assertCount(1, Post::all());

        $this->deleteStoreFile(Post::all()->pluck("cover")->toArray());
    }

    /** @test */
    public function test_a_blog_can_be_created_and_linked_to_its_tags()
    {
        $this->withoutExceptionHandling();

        Storage::fake('avatars');

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => true,
            "cover" => UploadedFile::fake()->image('avatar.jpg'),
            "tags" =>"php,java,javascript"
        ];

        $this->postJson(route("api.posts.store"), $data);

        $post = Post::first();

        $this->assertEquals(3, $post->tags()->count());

        $this->deleteStoreFile(Post::all()->pluck("cover")->toArray());
    }


    /** @test */
    public function a_post_requires_a_title_and_a_content_and_tags()
    {
        Storage::fake('avatars');

        $data = [
            "title" => "",
            "content" => "",
            "category_id" => "",
            "online" => true,
            "cover" => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $response = $this->postJson(route("api.posts.store"), $data)->json();

        $this->assertContains("title", array_keys($response["errors"]));
        $this->assertContains("content", array_keys($response["errors"]));
        $this->assertContains("tags", array_keys($response["errors"]));

        $this->deleteStoreFile(Post::all()->pluck("cover")->toArray());
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
            "cover" => UploadedFile::fake()->image('avatar.jpg'),
            "tags" => "php,java"
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
            "tags" => "php,java"
        ];

        $this->putJson(route("api.posts.update", $post), $data);

        $post = $post->fresh();

        $this->assertEquals($data["title"], $post->title);
        $this->assertEquals($data["online"], !! $post->online);
    }

    /** @test */
    public function blog_post_tags_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $post = create(Post::class, ["title" => "Old title", "online" => true]);
        $tagNames = ["php", "javascript", "java"];
        $tagIds = Tag::add($tagNames);

        $post->tags()->attach($tagIds);

        $this->assertEquals(3, $post->tags()->count());

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => false,
            "tags" => "php,python,elixir,kotlin,elm"
        ];

        $this->putJson(route("api.posts.update", $post), $data);

        $post = $post->fresh();

        $this->assertEquals(5, $post->tags()->count());
    }


    /** @test */
    public function post_cover_images_can_be_updated()
    {
        $post = create(Post::class, ["title" => "Old title", "online" => true]);

        $data = [
            "title" => "Lorem ipsum",
            "content" => $this->faker->paragraph,
            "category_id" => create(Category::class)->id,
            "online" => false,
            "cover" => UploadedFile::fake()->image('avatar.jpg'),
            "tags" => "php,java"
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
