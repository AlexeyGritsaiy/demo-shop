<?php

namespace App\Http\Livewire;

use App\Classes\Basket;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = [
        'productAdded' => 'noop',
        'productRemoved' => 'noop',
    ];

    public function noop(){}

    public function render()
    {
        $order = (new Basket(true))->getOrder();

        $count = 0;

        foreach ($order->products as $item) {
            $count += $item->pivot->count;
        }

        return view('livewire.cart-counter', [
            'count' => $count,
        ]);
    }
}
