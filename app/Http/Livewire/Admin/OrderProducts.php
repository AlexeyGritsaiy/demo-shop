<?php


namespace App\Http\Livewire\Admin;

use App\Classes\Basket;
use App\Entity\Adverts\Advert\Advert;
use App\Models\Order;
use Livewire\Component;

class OrderProducts extends Component
{
    public $orderId;

    public $name;
    public $phone;
    protected $listeners = [
        'order_add_product' => 'addProduct',
    ];
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Basket
     */
    private $basket;

    public function submitInfo()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|string|min:5',
        ]);

        $order = $this->getOrder();
        $order->update([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
    }

    /**
     * @return Order
     */
    private function getOrder(): Order
    {
        if (!$this->order) {
            $this->order = $this->getBasket()->getOrder();
        }

        return $this->order;
    }

    public function getBasket(): Basket
    {
        if(!$this->basket) {
            $this->basket = (new Basket(null, $this->orderId));
        }

        return $this->basket;
    }

    /**
     * @param  int  $orderId
     */
    public function mount(int $orderId)
    {
        $this->orderId = $orderId;

        $order = $this->getOrder();
        $this->name = $order->name;
        $this->phone = $order->phone;
    }

    public function addProduct(array $data)
    {
        $this->getBasket()->addProduct(Advert::find($data['id']));
    }

    public function removeRow(int $productId)
    {
        $this->getBasket()->removeRowProduct(Advert::find($productId));
    }

    public function incrementProduct(int $productId)
    {
        $this->getBasket()->addProduct(Advert::find($productId));
    }

    public function decrementProduct(int $productId)
    {
        $this->getBasket()->removeProduct(Advert::find($productId));
    }

    public function render()
    {
        $order = $this->getOrder();

        $products = $order->products;

        return view('livewire.admin.order_products', compact('products', 'order'));
    }
}
