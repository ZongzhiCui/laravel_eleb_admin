<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'signup_start' => date($format = 'Y-m-d', $max = 'now'),
        'signup_end' => date($format = 'Y-m-d', $max = '+7 day'),
        'prize_date' => date($format = 'Y-m-d', $max = 'next week'),
        'signup_num' => 10000,
        'is_prize' => 0, // secret
//        'remember_token' => str_random(10),
    ];
});
