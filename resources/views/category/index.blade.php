<?php
/**
 * @var $categories \App\Entity\Adverts\Category[]
 */
?>
@extends('layouts.app')

@section('content')
    <div class="filter-widget" style="float: left;padding-right: 15px;">

        <div class="card-header">
            All Categories
        </div>

        @include('layouts.partials.sidemenu.menu', ['categories' => $categories])
    </div>
    <h1>
        {{$category->name}}
    </h1>
    <div class="row">

        @foreach($adverts as $advert)
{{--           <h1>test</h1>--}}
{{--            @include('adverts.index', compact('advert'))--}}
            <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <a href="{{ route('adverts.show', $advert) }}">
                            @if($advert->photos->first())
                                <img src="{{ $advert->photos->first()->getUrl() }}" alt="">
                            @endif

                        </a>
                        <div class="pi-links">
                            <a href="#" class="add-card">
                                <i class="flaticon-bag"></i>
                                <span>ADD TO CART</span>
                            </a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>{{ $advert->price }}</h6>
                        <p><a href="{{ route('adverts.show', $advert) }}">{{ $advert->title }}</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
