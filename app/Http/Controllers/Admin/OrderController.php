<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\CreateRequest;
use App\Http\Requests\Admin\Orders\UpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products'])->orderByDesc('created_at')->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $products = $order->products;

        return view('admin.orders.show', compact('order', 'products'));
    }

    public function create(Request $request)
    {
        if ($request->get('orderId')) {
            $order = Order::find((int) $request->get('orderId'));
        } else {
            $order = Order::create([
                'user_id' => \Auth::id(),
            ]);

            return redirect()->route('admin.orders.create', ['orderId' => $order->id]);
        }

        return view('admin.orders.create', compact('order'));
    }

    public function store(CreateRequest $request)
    {
        $order = Order::new(
            $request['name'],
            $request['phone'],
            $request['status']


        );

        return redirect()->route('admin.orders.show', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $categories = Category::get();
        $adverts = Advert::get();
        return view('admin.orders.edit',
            compact('adverts', 'categories', 'order')
        );
    }

    public function update(UpdateRequest $request, Order $order)
    {
        $order->update($request->only('name'));

        return redirect()->route('admin.orders.show', $order);
    }


}
