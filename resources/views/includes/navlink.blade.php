<li class="nav-item">
    <a class="{{ Str::startsWith(Route::currentRouteName(), $route) ? 'nav-link active' : 'nav-link' }}" href="{{ route($route) }}">
        <i class="{{ $icon }}"></i> {{ $label }}
    </a>
</li>
