<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        $cover_path = asset("storage/covers/default.jpg");

        for ($i = 0; $i < 20; $i++) {
            $post = factory(\App\Models\Post::class)->create(["cover_path" => $cover_path, "visits" => random_int(0, 20)]);
            factory(\App\Models\Comment::class, random_int(0, 4))->create(["post_id" => $post->id]);
        }

    }
}
