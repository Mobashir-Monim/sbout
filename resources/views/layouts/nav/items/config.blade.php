<a class="nav-item no-hover-text-decor container-fluid" href="{{ route('config.index') }}">
    <li class="nav-link no-hover-text-decor text-white d-flex  {{ startsWith(request()->url(), route('config.index')) ? 'active' : '' }}">
        <span class="material-icons-outlined pr-2 my-auto">app_settings_alt</span>
        <span class="d-inline-block my-auto">Config {!! request()->url() == route('config.index') ? '<span class="sr-only">(current)</span>' : '' !!}</span>
    </li>
</a>