<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\PointTransaction::class, function (Faker $faker) {
    return [
        'invoice_number' => 'PO' . $faker->unique()->isbn10,
        'invoice_date' => $faker->dateTimeThisYear(),
        'description' => $faker->realText(150),
        'transaction_status' => $faker->boolean(75) ? 'confirmed' : ($faker->boolean(50) ? 'rejected' : 'canceled'),
        'user_log' => 'test'
    ];
});