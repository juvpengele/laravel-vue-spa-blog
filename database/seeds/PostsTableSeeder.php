<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cover_path = asset("storage/covers/default.jpg");

        factory(\App\Models\Post::class, 10)->create(["cover_path" => $cover_path]);
    }
}
