<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTagsTest extends TestCase
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
    public function we_can_see_all_tags()
    {
        create(Tag::class, [], 3);

        $response = $this->get(
            route("api.tags.index")
        )->json();

        $this->assertCount(3, $response["data"]);
    }

    /** @test */
    public  function a_tag_can_be_updated_only_by_the_admin()
    {
        $tag = create(Tag::class, ["name" => "default tag"]);

        $response = $this->putJson(
            route("api.tags.update", $tag),
            ["name" => "new tag"]
        )->json();

        $this->assertEquals("new tag", $response["data"]["name"]);
    }


}
