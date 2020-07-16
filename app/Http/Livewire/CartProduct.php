<?php

namespace App\Http\Livewire;

use App\Classes\Basket;
use App\Entity\Adverts\Advert\Advert;
use App\Models\Order;
use Livewire\Component;
//use App\Http\Controllers\BasketController;

class CartProduct extends Component
{
    public $advertId;
    public $title;
    public $price;
    public $image;
    protected $order;

    /**
     * Basket constructor.
     * @param  bool  $createOrder
     */


    public function mount(Advert $advert)
    {
        $this->advertId = $advert->id;
        $this->title = $advert->title;
        $this->price = $advert->price;
        $this->image = $advert->photos->first();

    }

    public function add()
    {

$advert = Advert::find($this->advertId);

        $result = (new Basket(true))->addProduct($advert);

        if ($result) {
           // echo 'www';
//            session()->flash('success', 'Добавлен товар '.$advert->title);
        session()->flash('success', 'Добавлен товар ');
//      //  dd(session()->flash('success'));
        }
        Order::first()->products()->attach($this->advertId);
        $this->emit('productAdded');
    //    dd(session()->flash());
    }

    public function remove()
    {
        Order::first()->products()->detach($this->advertId);
        $this->emit('productRemoved');
    }

    public function render()
    {
    //    return view('livewire.cart-product');
        return view('livewire.cart-product'
            ,
            [
            'alreadyAdded' => Order::first()->products()->where('advert_id', '=', $this->advertId)->exists(),
            ]);
    }
}
