{{--<div class="up-item">--}}
{{--    <div class="shopping-card">--}}
{{--        <i class="flaticon-bag"></i>--}}
{{--        <span>{{$count}}</span>--}}
{{--    </div>--}}
{{--    <a href="{{ route('basket') }}">Shopping Cart</a>--}}
{{--</div>--}}
<div class="up-item">
        <div class="shopping-card">
            <i class="flaticon-bag"></i>
            <span>{{$count}}</span>

        </div>
        <a href="{{ route('basket') }}" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">Shopping Cart</a>
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">--}}
{{--        Shopping Cart--}}
{{--    </button>--}}

<!-- Modal -->
    @livewire('App\Http\Livewire\CartIndex')

</div>