<?php
namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserSetting;
use Faker\Generator as Faker;

$factory->define(UserSetting::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(\App\Models\User::class)->create([
                'user_type_id' => 1])->id;
        },
        'grade' => rand(1, 4),
        'faculty' => $faker->randomElement(['教育', '人文', '経済', '工', '農', '理', '医', '創生']),
        'hometown' => $faker->city,
        'introduce' => $faker->sentence,
        'gender_id' => rand(1, 3)
    ];
});
