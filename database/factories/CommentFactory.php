<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "author_name" => $faker->name,
        "author_email" => $faker->email,
        "content" => $faker->paragraph,
        "post_id" => factory(\App\Models\Post::class)->create()->id
    ];
});
