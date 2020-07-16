<?php
/**
 * @var $categories \App\Entity\Adverts\Category[]
 */
?>
<ul class="category-menu">
    @foreach ($categories as $category)
        <li>
            <a href="{{ route('category', $category->slug) }}" @lm_attrs($chunk)
               @if($category->parent_id) class="dropdown"
               @endif data-test="test" @lm_endattrs>
                {{ $category->name }}
            </a>

            @include('layouts.partials.sidemenu.submenu', ['category' => $category])
        </li>
    @endforeach
</ul>
