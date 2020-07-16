<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Entity\Adverts\Advert\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        return view('basket');
    }

    public function basketConfirm(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
        }

        Order::eraseOrderSum();

        return redirect()->route('home');
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
//        dd($order);
//        if (!$basket->countAvailable()) {
//            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
//            return redirect()->route('basket');
//        }
        return view('order', compact('order'));
    }

    public function basketAdd(Advert $advert)
    {
        $result = (new Basket(true))->addProduct($advert);

        if ($result) {
            session()->flash('success', 'Добавлен товар '.$advert->title);
        } else {
            session()->flash('warning', 'Товар '.$advert->title . ' в большем кол-ве не доступен для заказа');
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Advert $advert)
    {
        (new Basket())->removeProduct($advert);

        session()->flash('warning', 'Удален товар  '.$advert->title);

        return redirect()->route('basket');
    }
    public function adverts()
    {
        return $this->belingsToMany(Advert::class);
    }
}
