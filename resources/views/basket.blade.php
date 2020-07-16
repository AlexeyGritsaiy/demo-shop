<?php
/**
 * @var $products \App\Entity\Adverts\Advert\Advert[]
 * @var $order \App\Models\Order
 */
?>
@extends('layouts.app')

@section('content')

    <section class="cart-section spad">
        <div class="container">
            <div class="row">
                @livewire('App\Http\Livewire\Cart')

                <div class="col-lg-4 card-right">
                    <form class="promo-code-form">
                        <input type="text" placeholder="Enter promo code">
                        <button>Submit</button>
                    </form>
                    <a href="{{ route('basket-place') }}" class="site-btn">Proceed to checkout</a>
                    <a href="" class="site-btn sb-dark">Continue shopping</a>
                </div>
            </div>
        </div>
    </section>
    <!-- cart section end -->

    <!-- Related product section -->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title text-uppercase">
                <h2>Continue Shopping</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <div class="tag-new">New</div>
                            <img src="./img/product/2.jpg" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Black and White Stripes Dress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related product section end -->

@endsection