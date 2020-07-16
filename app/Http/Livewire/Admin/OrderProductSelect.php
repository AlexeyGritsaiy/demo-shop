<?php

namespace App\Http\Livewire\Admin;

use App\Entity\Adverts\Advert\Advert;
use Livewire\Component;

class OrderProductSelect extends Component
{
    public $productId;

    public function addProduct()
    {
        $this->emit('order_add_product', ['id' => $this->productId]);
    }

    public function render()
    {
        $adverts = Advert::all();

        return view('livewire.admin.order', compact('adverts'));
    }
}
