<?php

use App\Entity\Adverts\Advert\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturerTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Manufacturer::class, 20)->create();
    }
}
