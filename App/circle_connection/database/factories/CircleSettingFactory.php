<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CircleSetting;
use Faker\Generator as Faker;

$factory->define(CircleSetting::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(\App\Models\User::class)->create([
                'user_type_id' => 2])->id;
        },
        'circle_category_id' => rand(1, 4),
        'scale_id' => rand(1, 4),
        'introduce' => $faker->sentence,
        'content' => $faker->sentence,
        'place' => $faker->city,
    ];
});
