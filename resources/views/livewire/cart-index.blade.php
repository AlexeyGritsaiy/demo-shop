<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">    <h3>Your Cart</h3></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="cart-table-warp">
                    <table>
                        <thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="product-col">
                                    <a href="{{ route('adverts.show', $product) }}">
                                            <img src="{{ $product->photos->first()->getUrl() }}" width="60px" height="60px" alt="">

                                    </a>
                                </td>
                                <td>
                                    <div class="pc-title">
                                        <a href="{{ route('adverts.show', $product) }}">
                                            <p>{{ $product->title }}</p>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click="removeRow({{ $product->id }})">Remove</a>
                                </td>

{{--                                <td>--}}
{{--                                    <div class="btn-group form-inline">--}}
{{--                                        <div class="quantity">--}}
{{--                                            <div class="pro-qty">--}}
{{--                                                <span class="dec qtybtn" wire:click="decrementProduct({{ $product->id }})">-</span>--}}
{{--                                                <input type="text" value="{{ $product->pivot->count }}">--}}
{{--                                                <span class="inc qtybtn" wire:click="incrementProduct({{ $product->id }})">+</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                                <td class="total-col"><h4>{{ $product->price }}</h4></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

     <hr>
         <td>
             <div class="total-cost">
                 <h6>Total <span>{{ $order->getFullSum() }}</span></h6>
             </div>
         </td>
     </hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
                    <a href="{{ route('basket') }}">Shopping Cart</a>
            </div>

        </div>
    </div>
</div>