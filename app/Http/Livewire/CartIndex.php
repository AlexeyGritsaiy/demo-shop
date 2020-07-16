<?php

namespace App\Http\Livewire;

use App\Classes\Basket;
use App\Entity\Adverts\Advert\Advert;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CartIndex extends Component
{
    public $orderId;

    /**
     * @var Order
     */
    public $order;
    /**
     * @var Advert[]|Collection
     */

    /**
     * @var Basket
     */
    private $basket;

    public $products;

    public function getBasket(): Basket
    {
        if(!$this->basket) {
            $this->basket = (new Basket(null, $this->orderId));
        }

        return $this->basket;
    }


    public function removeRow(int $productId)
    {
        $this->getBasket()->removeRowProduct(Advert::find($productId));
    }



    public function render()
    {
        $order = (new Basket())->getOrder();

        $this->order = $order;
        $this->products = $order->products;

        return view('livewire.cart-index', compact('order','products'));
    }
}
