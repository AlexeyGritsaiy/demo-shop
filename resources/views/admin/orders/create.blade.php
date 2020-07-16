<?php
/**
 * @var $order \App\Models\Order
 */
?>
@extends('layouts.mmaster')

@section('title', 'Order create')

@section('content_header')
    <h1>Order create</h1>
@stop

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <div class="container-fluid">
            <div class="row">
                @livewire('App\Http\Livewire\Admin\OrderProductSelect')
            </div>
            <div class="row">
                @livewire('App\Http\Livewire\Admin\OrderProducts', ['orderId' => $order->id])
            </div>
        </div>
    </div>
@endsection
