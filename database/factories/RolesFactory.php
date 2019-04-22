<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Roles::class, function (Faker $faker) {
    return [
        [
            'id' => 1,
            'role_name' => 'Administrator',
            'slug' => 'administrator',
            'is_active' => true,
        ],
        [
            'id' => 2,
            'role_name' => 'Member',
            'slug' => 'member',
            'is_active' => true,
        ]
    ];
});
