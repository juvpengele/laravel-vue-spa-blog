<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        $faker = Faker::create();

        $cover_path = asset("cover.jpg");

        factory(\App\Models\Category::class, 5)->create();

        for ($i = 0; $i < 20; $i++) {

            $category = \App\Models\Category::find(random_int(1, 5));

            $title = $faker->sentence("5");

            $post = $category->posts()->create([
                "title" => $title,
                "slug"  => \Illuminate\Support\Str::slug($title),
                "content"  => $faker->text,
                "category_id" => random_int(1, 5),
                "user_id" => factory(\App\User::class)->create()->id,
                "online" => true,
                "cover_path" => $cover_path,
                "visits" => random_int(0, 50)
            ]);

            factory(\App\Models\Comment::class, random_int(0, 4))->create(["post_id" => $post->id]);
        }

    }
}
