@extends('layouts.mmaster')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.orders.update' , $order) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">
                Common
            </div>
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="name" class="col-form-label">name</label>
                            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $order->name) }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="phone" class="col-form-label">phone</label>--}}
{{--                            <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $order->phone) }}" required>--}}
{{--                            @if ($errors->has('phone'))--}}
{{--                                <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


{{--                <div class="form-group">--}}
{{--                    <label for="content" class="col-form-label">Content</label>--}}
{{--                    <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="10" required>{{ old('content', $advert->content) }}</textarea>--}}
{{--                    @if ($errors->has('content'))--}}
{{--                        <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection