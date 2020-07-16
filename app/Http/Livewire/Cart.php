<?php

namespace App\Http\Livewire;

use App\Classes\Basket;
use App\Entity\Adverts\Advert\Advert;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Cart extends Component
{
    /**
     * @var Order
     */
    public $order;
    /**
     * @var Advert[]|Collection
     */
    public $products;

    public function incrementProduct(int $productId, Basket $basket)
    {
        $basket->addProduct(Advert::find($productId));

        $this->emit('productAdded');
    }

    public function decrementProduct(int $productId, Basket $basket)
    {
        $basket->removeProduct(Advert::find($productId));

        $this->emit('productRemoved');
    }

    public function render()
    {
        $order = (new Basket())->getOrder();

        $this->order = $order;
        $this->products = $order->products;

        return view('livewire.cart');
    }
}
