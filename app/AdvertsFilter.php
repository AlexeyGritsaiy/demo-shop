<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Entity\Adverts\Category;
use App\Entity\Adverts\Advert\Advert;

class AdvertsFilter extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('title', 'like', "%$value%");
    }
//aaaaaaaaaaaaaaaaaaaaa
        public function priceFrom($value)
    {
        if (! $value) return;
        $this->builder->where('price', '>=', (int)$value);
    }

    public function priceTo($value)
    {
        if (! $value) return;
        $this->builder->where('price', '<=', (int)$value);
    }


    public function nameCat($value)
    {
        if (! $value) return;
        $this->builder->whereHas('category', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }

}