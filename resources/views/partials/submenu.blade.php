<li class="nav-item">
    <a class="nav-link" href="{{ $menu['url'] }}" onclick="toggleMenu(event, 'menu-{{ $menu['id'] }}')">
        @if (!empty($menu['icon']))
            <i class="{{ $menu['icon'] }}"></i>
        @endif
        {{ $menu['title'] }}
    </a>

    @if (!empty($menu['submenu']))
        <ul id="menu-{{ $menu['id'] }}" class="submenu">
            @foreach ($menu['submenu'] as $submenu)
                @include('partials.submenu', ['menu' => $submenu])
            @endforeach
        </ul>
    @endif
</li>
