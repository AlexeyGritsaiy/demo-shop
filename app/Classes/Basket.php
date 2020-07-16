<?php

namespace App\Classes;

use App\Entity\Adverts\Advert\Advert;
use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class Basket
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var bool
     */
    protected $local = false;

    /**
     * Basket constructor.
     * @param  bool  $createOrder
     * @param  int|null  $orderId
     */
    public function __construct($createOrder = false, int $orderId = null)
    {
        if ($orderId) {
            $this->local = true;
        } else {
            $orderId = session('orderId');
        }

        if (is_null($orderId) && $createOrder) {
            $this->createOrder();
        } else {
            $this->order = Order::find($orderId);
        }

        if (!$this->order) {
            $this->createOrder();
        }
    }

    protected function createOrder(): void
    {
        $data = [];
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $this->order = Order::create($data);

        if (!$this->local) {
            session(['orderId' => $this->order->id]);
        }
    }

    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(true)) {
            return false;
        }
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
        return $this->order->saveOrder($name, $phone);
    }

    public function countAvailable($updateCount = false)
    {
        foreach ($this->order->products as $orderProduct) {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) {
                return false;
            }
            if ($updateCount) {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }

        if ($updateCount) {
            $this->order->products->map->save();
        }

        return true;
    }

    protected function getPivotRow($product)
    {
        return $this->order->products()->where('advert_id', $product->id)->first()->pivot;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    public function removeProduct(Advert $advert)
    {
        if ($this->order->products->contains($advert->id)) {
            $pivotRow = $this->getPivotRow($advert);
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($advert->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        if (!$this->local) {
            Order::changeFullSum(-$advert->price);
        }
    }

    public function removeRowProduct(Advert $advert)
    {
        if ($this->order->products->contains($advert->id)) {
            $this->order->products()->detach($advert->id);
        }
    }

    public function addProduct(Advert $advert)
    {
        if ($this->order->products->contains($advert->id)) {
            $pivotRow = $this->getPivotRow($advert);

            $pivotRow->count++;

            $pivotRow->update();
        } else {
            $this->order->products()->attach($advert->id);
        }

        if (!$this->local) {
            Order::changeFullSum($advert->price);
        }

        return true;
    }
}
