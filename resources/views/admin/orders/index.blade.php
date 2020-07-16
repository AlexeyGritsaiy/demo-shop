<?php
/**
 * @var $orders \App\Models\Order[]|\Illuminate\Pagination\LengthAwarePaginator
 */
?>
@extends('layouts.mmaster')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Заказы</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <a href="{{ route('admin.orders.create') }}" class="btn btn-success">Новый заказ</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Когда создан</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                            <td>{{ $order->calculateFullSum() }} руб.</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-success"
                                       @admin
                                       href="{{ route('admin.orders.show', $order) }}">Открыть</a>
                                    <a class="btn btn-warning"
                                       href="{{ route('admin.orders.create', ['orderId' => $order->id]) }}">Редактировать</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $orders->links() }}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
