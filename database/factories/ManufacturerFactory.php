<?php

use App\Entity\Adverts\Advert\Manufacturer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
    ];
});
