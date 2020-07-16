<?php

namespace App\Services\Banner;

class CostCalculator
{
    private $price;

    public function __construct(int $price)
    {
        $this->price = (int)$price;
    }

    public function calc(int $views): int
    {
        return floor($this->price * ((int) $views / 1000));
    }
}