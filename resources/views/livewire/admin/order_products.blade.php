<?php
/**
 * @var $order \App\Models\Order
 */
?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1"
                                 class="img-circle img-size-32 mr-2">
                            {{ $product->title }}
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <div class="btn-group form-inline">
                                <span class="btn btn-flat btn-danger"
                                      wire:click="decrementProduct({{ $product->id }})">-</span>
                                <input type="text" value="{{ $product->pivot->count }}">
                                <span class="btn btn-flat btn-success"
                                      wire:click="incrementProduct({{ $product->id }})">+</span>
                            </div>
                        </td>
                        <td>
                            <a href="#" wire:click="removeRow({{ $product->id }})">Remove</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        Total <span>{{ $order->calculateFullSum() }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">User info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" lpformnum="2" wire:submit.prevent="submitInfo">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" wire:model="name" class="form-control" placeholder="Enter name">

                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" wire:model="phone" placeholder="Enter phone">

                                @error('phone') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
