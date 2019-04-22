<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Member::class, function (Faker $faker) {
    $verification_date = $faker->boolean($changeOfGettingTrue = 70) ? $faker->dateTimeThisYear($max='now', $timezone = null) : null;
    return [
        'member_type_id' => $faker->numberBetween(1, 4),
        'role_id' => 2,
        'referral_id' => null,
        'member_code' => $faker->isbn10,
        'referral_code' => $faker->isbn10,
        'registration_date' => $faker->dateTimeThisYear($max='now', $timezone = null),
        'current_point' => $faker->numberBetween(100, 5000),
        'verified_at' => $verification_date,
        'is_verified' => !is_null($verification_date),
        'user_log' => 'test'
    ];
});