<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="col-lg-4 col-sm-6">
        <div class="product-item">
            <div class="pi-pic">
                {{--                <a href="{{ route('adverts.show', $advert) }}">--}}
                <img src="{{ $image}}" alt="">

                {{--                </a>--}}
                <div class="pi-links">

                    {{--                    <form action="{{ route('basket-add', $advert) }}" method="POST">--}}
                    {{--                        <a href="" class="add-card">--}}
                    {{--                            <i class="flaticon-bag"></i>--}}


                    <div class="test21">
                        @if(session()->has('success'))
                            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    @unless($alreadyAdded)

                        <button
                                class="border border-green hover:bg-green px-3 py-2 rounded-full text-green hover:text-while"
                                style="outline: none !important;"
                                wire:click="add"
                        ><span> ADD TO CART</span>
                        </button>
                        <div>
                            {{--@error('add')--}}
                            {{--                            @enderror--}}

                            @else
                                <button
                                        wire:click="remove"><span>Remove</span>
                                </button>
                            @endunless
                            {{--                        </a>--}}

                            {{--                        @csrf--}}
                            {{--                    </form>--}}

                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
            </div>
            <div class="pi-text">
                <h6>{{ $price }}</h6>
{{--                <p><a href="{{ route('adverts.show', $advert) }}">{{ $advert->title }}</a></p>--}}
                <p>{{ $title }}</p>
{{--                <p>Category: {{ $advert->category->name }}</p>--}}
            </div>
            </div>
        </div>
    </div>
</div>


