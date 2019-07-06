<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        "name" => $name,
        "slug" => \Illuminate\Support\Str::slug($name)
    ];
});
