<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PointTransactionDetail::class, function (Faker $faker) {
    $is_redeem = $faker->boolean(50);
    return [
        'point_earned' => !$is_redeem ? $faker->numberBetween(10, 100) : null,
        'point_redeem' => $is_redeem ? $faker->numberBetween(10, 100) : null,
        'description' => $faker->realText($faker->numberBetween(50, 100)),
    ];
});
