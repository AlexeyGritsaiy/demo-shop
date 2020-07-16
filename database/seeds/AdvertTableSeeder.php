<?php

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use Illuminate\Database\Seeder;

class AdvertTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Advert::class, 100)->create()->each(function (Advert $advert) {
            $categories = Category::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray();

            $advert->categories()->sync($categories);
        });
    }
}
