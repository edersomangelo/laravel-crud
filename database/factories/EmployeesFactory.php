<?php

use Faker\Generator as Faker;

$factory->define(\App\Employees::class, function (Faker $faker) {
    $companies = \App\Companies::all()->pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'company_id' => $faker->randomElement($companies)
    ];
});