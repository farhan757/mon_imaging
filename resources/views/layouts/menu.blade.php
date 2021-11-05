@inject('menus','App\Http\Controllers\MenuController')
@php
$cntr = 0;
@endphp

<ul class="nav navbar-nav">
    <li><a href="{{ route('home') }}"><span class="fa fa-home"></span> Home</a></li>
    @foreach($menus->menu() as $parent)    
        @if(count($menus->menu($parent->id)))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="{{ $parent->icon }}"></span> {{ $parent->name_menu }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
            @foreach($menus->menu($parent->id) as $child)
            <li><a href="{{ route($child->url) }}">{{ $child->name_menu }}</a></li>    
            @endforeach
                    </ul>
            </li>
        @else
            <li><a href="{{ route($parent->url) }}"><span class="{{ $parent->icon }}"></span> {{ $parent->name_menu }}</a></li>
        @endif
    @endforeach
</ul>