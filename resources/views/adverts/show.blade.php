<?php
/**
 * @var $advert \App\Entity\Adverts\Advert\Advert
 */
?>
@extends('layouts.app')

@section('content')
    <!-- product section -->
    <section class="product-section">
        <div class="container">
            <div class="back-link">
            <div class="row">
                <div class="col-lg-6">
{{--                    {{dump($advert->attributes)}}--}}
{{--                    @foreach($advert->values as $key => $value)--}}
{{--                        {{$key}}--}}
{{--                        <h1>w</h1>--}}
{{--                    @endforeach--}}
                    @if($advert->photos->first())

                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="{{ $advert->photos->first()->getUrl() }}" alt="">
                        </div>
                    @endif

                    @if($advert->photos->count() > 1)
                        <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                            <div class="product-thumbs-track">
                                @foreach($advert->photos as $key => $photo)
                                    <div class="pt{{ $loop->first ? ' active' : '' }}"
                                         data-imgbigurl="{{ $photo->getUrl() }}">
                                        <img src="{{ $photo->getUrl() }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 product-details">
                    <h2 class="p-title">{{ $advert->title  }}</h2>
                    <h3 class="p-price">Price : Zl. {{ $advert->price }}/m2 </h3>
                    <h4 class="p-stock">Available: <span>In Stock</span></h4>
                    <div class="p-rating">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o fa-fade"></i>
                    </div>
                    <div class="p-review">
                        <a href="">3 reviews</a>|<a href="">Add your review</a>
                    </div>
                    <div class="quantity">
                        <p>Quantity</p>

                        <div class="pro-qty">
{{--                            <form action="{{ route('basket-remove', $advert) }}" method="POST">--}}
{{--                                <button type="submit" class="btn btn-danger"--}}
{{--                                        href=""><span--}}
{{--                                            class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                            <input type="text" value="{{ $advert->pivot->count }}">--}}
{{--                            <form action="{{ route('basket-add', $advert) }}" method="POST">--}}
{{--                                <button type="submit" class="btn btn-success"--}}
{{--                                        href=""><span--}}
{{--                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>--}}
{{--                                @csrf--}}
{{--                            </form>--}}
                        </div>

                    </div>
                    <a href="#" class="site-btn">SHOP NOW</a>
                    <div id="accordion" class="accordion-area">
                        <div class="panel">
                            <div class="panel-header" id="headingOne">
                                <button class="panel-link active" data-toggle="collapse" data-target="#collapse1"
                                        aria-expanded="true" aria-controls="collapse1">information
                                </button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="panel-body">
                                    <p>{!! nl2br(e($advert->content)) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-header" id="headingTwo">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="panel-body">
                                    <img src="./img/cards.png" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-header" id="headingThree">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="panel-body">
                                    <h4>7 Days Returns</h4>
                                    <p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @livewire('tickets')
                    @livewire('comments')
                    <div class="social-sharing">
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-pinterest"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- product section end -->


    <!-- RELATED PRODUCTS section -->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title">
                <h2>RELATED PRODUCTS</h2>
            </div>
            <div class="product-slider owl-carousel">
                @foreach($adverts as $advert)
                    <div class="product-item">
                        <div class="pi-pic">
                            <a href="{{ route('adverts.show',$advert)}}">
                                <img src="{{ $advert->photos->first()->getUrl() }}"  style="height: 150px" alt="">
                            </a>
                            <div class="pi-links">

                                <a href="" class="add-card">
                                    <i class="flaticon-bag"></i>
                                    <span>ADD TO CART</span>
                                </a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <a href="{{ route('adverts.show',$advert)}}" style="color: black;">
                                <h6>Zl: {{ $advert->price }}/m2</h6>
                                <p>{{ $advert->title }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS section end 