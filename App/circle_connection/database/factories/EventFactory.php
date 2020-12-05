<?php
namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $start_time = $faker->dateTimeThisMonth;
    print_r($start_time);
    $end_time = $start_time->modify('+1 hour')->format('Y-m-d H:i:s');
    $fee = rand(1, 10) * 100;
    return [
        'circle_id' => rand(3, 30),
        'title' => $faker->word,
        'content' => $faker->sentence,
        'meeting_place' => $faker->city,
        'place' => $faker->city,
        'start_time' => date("Y-m-d H:i:s",strtotime("+1 month")),
        'end_time' => date("Y-m-d H:i:s",strtotime("+1 month +2 hour")),
        'number_of_persons' => rand(10, 50),
        'fee' => $fee
    ];
});
