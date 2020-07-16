<div>
{{--    <form class="header-search-form">--}}
            <div class="input-group my-group">
                <select wire:model="searchCategoryId"  data-live-search="true"  id="lunch"
                        class="selectpicker form-control" title="Please select a lunch ...">
                    <option>Select category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <input type="text"  name="snpid"
                       class="form-control"
                       placeholder="Search Products..."
                       wire:model="searchTerm"
                       wire:keydown.escape="reset"
                       wire:keydown.tab="reset"
                       wire:keydown.ArrowUp="decrementHighlight"
                       wire:keydown.ArrowDown="incrementHighlight"
                       wire:keydown.enter="selectContact"
                />
                <span class="input-group-btn">
    <button class="btn btn-default" type="submit"><i class="flaticon-search"></i></button>
                </span>

            </div>
{{--    </form>--}}
</div>





            <div>
{{--    <input type="text"--}}
{{--           class="form-input"--}}
{{--           placeholder="Search Products..."--}}
{{--           wire:model="searchTerm"--}}
{{--           wire:keydown.escape="reset"--}}
{{--           wire:keydown.tab="reset"--}}
{{--           wire:keydown.ArrowUp="decrementHighlight"--}}
{{--           wire:keydown.ArrowDown="incrementHighlight"--}}
{{--           wire:keydown.enter="selectContact"--}}
{{--    />--}}

    <div wire:loading class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
        <div class="list-item">Searching...</div>
    </div>

    @if(!empty($searchTerm))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="reset"></div>

        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
            @if(!empty($adverts))
                @foreach($adverts as $i => $advert)
                    <a
                            href="{{ route('adverts.show', $advert['id']) }}"
                            class="list-item {{ $highlightIndex === $i ? 'highlight' : '' }}"
                    >{{ $advert['title'] }}</a>
                @endforeach
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif

{{--    @if(!empty($searchTerm))--}}
{{--        <table class="table table-striped">--}}
{{--            <tbody>--}}
{{--            @foreach ($adverts as $advert)--}}
{{--                <tr>--}}
{{--                    <td><a href="{{ route('adverts.show', $advert) }}" target="_blank">{{ $advert->title }}</a></td>--}}
{{--                    <td>{{ $advert->category->name }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}

{{--            </tbody>--}}
{{--        </table>--}}


{{--        111111111--}}
{{--        <div class="search__item_content js__search-xhr-content">--}}
{{--            <div class="search__section" data-search-section-type="3" data-search-section-name="products">--}}
{{--                <ul class="search__list">--}}
{{--                    @foreach ($adverts as $advert)--}}
{{--                    <li class="search__list-item">--}}
{{--                        <a data-search-result-type="Product" href="{{ route('adverts.show', $advert) }}"--}}
{{--                           class="search__result-link js__search-result-link">--}}
{{--                            <div class="search__result-icon ">--}}
{{--                                <img src="/img/product/6.jpg" alt="prduct image">--}}
{{--                            </div>--}}
{{--                            <div class="search__result-content">--}}
{{--                                <div class="search__result-note">--}}

{{--                                </div>--}}
{{--                                <div class="search__result-title">--}}
{{--                                    <h5 class="search__result-title-item">{{ $advert->title }}</h5>--}}
{{--                                    <h6>{{ $advert->category->name }}</h6>--}}
{{--                                </div>--}}
{{--                                <div class="search__result-note">--}}
{{--                            <span class="search__result-note-item search__result-item_active">{{ $advert->price }} zł--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endpush
</div>

