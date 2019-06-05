<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        "name" => $name,
        "slug" => \Illuminate\Support\Str::slug($name)
    ];
});
