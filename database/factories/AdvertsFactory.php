<?php

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Advert\Manufacturer;
use App\Entity\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Advert::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->get()->first()->id;
        },
        'manufacturer_id' => function () {
            return Manufacturer::inRandomOrder()->get()->first()->id;
        },
        'title' => $faker->text(rand(5, 30)),
        'content' => $faker->text(rand(200, 5000)),
        'address' => $faker->address,
        'price' => rand(100, 9999),
        'status' => $faker->randomElement(Advert::statusesList()),
    ];
});

