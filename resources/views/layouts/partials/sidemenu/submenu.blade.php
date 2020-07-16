<?php
/**
 * @var $category \App\Entity\Adverts\Category
 */
?>
@if($category->children()->count())
    <ul class="sub-menu">
        @foreach ($category->children as $children)
            <li>
                <a href="{{ route('category', $children->slug) }}">{{ $children->name }}</a>
            </li>

            @include('layouts.partials.sidemenu.submenu', ['category' => $children])
        @endforeach
    </ul>
@endif