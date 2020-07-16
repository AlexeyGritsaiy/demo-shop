<?php

namespace App\Entity\Adverts\Advert;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $advert_id
 * @property boolean $is_main
 * @property int $sort_order
 * @property string file
 */
class Photo extends Model
{
    public $timestamps = false;

    protected $table = 'advert_advert_photos';

    protected $fillable = ['file', 'is_main', 'sort_order'];

    public function getUrl(): ?string
    {
        return Storage::disk('public')->url($this->mediaFilePath());
    }

    public function mediaFilePath()
    {
        return $this->mediaPath().DIRECTORY_SEPARATOR.$this->file;
    }

    public function mediaPath()
    {
        return 'images/item/'.$this->advert_id;
    }
}
