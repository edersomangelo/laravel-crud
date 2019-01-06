<?php

use Faker\Generator as Faker;

$factory->define(\App\Companies::class, function (Faker $faker) {
    $path='storage/app/public';
    $picture = $faker->image($path,100,100);
    $logo = str_replace([$path,'/'],'',$picture);
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'logo' => $logo,
        'website' => $faker->url
    ];
});
