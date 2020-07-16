@extends('layouts.app')

@section('content')

<!-- checkout section  -->
<section class="checkout-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-2 order-lg-1">
                <form action="{{ route('basket-confirm') }}" method="POST">
                    <div>
                        <p>Укажите свои имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>

                        <div class="container">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер
                                    телефона: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="phone" id="phone" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            @guest
                                <div class="form-group">
                                    <label for="name" class="control-label col-lg-offset-3 col-lg-2">Email: </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="email" id="email" value="" class="form-control">
                                    </div>
                                </div>
                            @endguest
                        </div>
                        <br>
                        @csrf
                        <input type="submit" class="btn btn-success" value="Подтвердить заказ">
                    </div>
                </form>
            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Your Cart</h3>
                    @foreach($order->products as $product)
                    <ul class="product-list">
                        <li>
                            <div class="pl-thumb">
                                <img height="56px" src="{{ Storage::url($product->image) }}"
                                     alt="{{ $product->price }}"></div>
                            <td><span class="badge">{{ $product->pivot->count }}</span>
                            </td>
                            <h6>{{ $product->name }}</h6>
                            <p>{{ $product->price }}</p>
                        </li>
                    </ul>
                    @endforeach
                    <ul class="price-list">
                        <li>Total<span>{{ $order->getFullSum() }}</span></li>
                        <li>Shipping<span>free</span></li>
                        <li class="total">Total<span>{{ $order->getFullSum() }}</span></li>
                    </ul>


                </div>

            </div>
        </div>
    </div>

</section>
@endsection
