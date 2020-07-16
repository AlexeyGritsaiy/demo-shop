<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Products;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Advert\Photo;
use App\Services\Advert\AdvertPhotoService;
use Livewire\Component;

class ProductImage extends Component
{
    public $advertId;

    public $files = [];

    public function mount(int $advertId)
    {
        $this->advertId = $advertId;
    }

    public function setAsMain(int $itemMedia, AdvertPhotoService $service)
    {
        $service->mainMedia($this->getAdvert(), $this->getItemMedia($itemMedia));
    }

    public function delete(int $itemMedia, AdvertPhotoService $service)
    {
        $service->removeMedia($this->getAdvert(), $this->getItemMedia($itemMedia));
    }

    public function sortUp(int $itemMedia, AdvertPhotoService $service)
    {
        $service->sortUp($this->getAdvert(), $this->getItemMedia($itemMedia));
    }

    public function sortDown(int $itemMedia, AdvertPhotoService $service)
    {
        $service->sortDown($this->getAdvert(), $this->getItemMedia($itemMedia));
    }

    /**
     * @return Advert
     */
    protected function getAdvert(): Advert
    {
        return Advert::find($this->advertId);
    }

    public function render()
    {
        $advert = $this->getAdvert();

        return view('livewire.admin.products.product_image', compact('advert'));
    }

    /**
     * @param  int  $itemMedia
     * @return mixed
     */
    protected function getItemMedia(int $itemMedia)
    {
        return Photo::find($itemMedia);
    }
}
