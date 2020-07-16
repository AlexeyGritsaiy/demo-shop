<?php

namespace App;

use App\Entity\Adverts\Advert;
use Illuminate\Database\Eloquent\Model;

class AdvertInfo extends Model
{
    protected $table = 'advert_info';
    /**
     * Define relationship for App\Entity\Adverts\Advert
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo(Advert\Advert::class);
    }
}