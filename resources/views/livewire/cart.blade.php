<div class="col-lg-8">
    <div class="cart-table">
        <h3>Your Cart</h3>
        <div class="cart-table-warp">
            <table>
                <thead>
                <tr>
                    <th class="product-th">Product</th>
                    <th class="quy-th">Quantity</th>
                    <th class="size-th">SizeSize</th>
                    <th class="total-th">Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="product-col">
                            <a href="{{ route('adverts.show', $product) }}">
                            @if($product->photos->first())
                                <img src="{{ $product->photos->first()->getUrl() }}" width="60px" height="60px" alt="">
                            @endif
                            </a>
                            <div class="pc-title">
                                <a href="{{ route('adverts.show', $product) }}">
                                <h4>{{ $product->title }}</h4>
                                </a>
                            </div>

                        </td>
                        <td>
                            <div class="btn-group form-inline">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <span class="dec qtybtn" wire:click="decrementProduct({{ $product->id }})">-</span>
                                        <input type="text" value="{{ $product->pivot->count }}">
                                        <span class="inc qtybtn" wire:click="incrementProduct({{ $product->id }})">+</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="size-col"><h4>Size M</h4></td>
                        <td class="total-col"><h4>{{ $product->price }}</h4></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="total-cost">
            <h6>Total <span>{{ $order->getFullSum() }}</span></h6>
        </div>
    </div>
</div>