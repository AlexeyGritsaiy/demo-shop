<?php

namespace App\Entity\Adverts\Advert;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class Manufacturer extends Model
{
    protected $table = 'advert_manufacturer';

    protected $fillable = ['name'];
}
