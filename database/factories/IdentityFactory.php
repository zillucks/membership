<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Identity::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->email,
        'mobile_number' => str_replace('+', '', $faker->e164phoneNumber),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip_code' => $faker->postcode,
        'user_log' => 'test'
    ];
});
