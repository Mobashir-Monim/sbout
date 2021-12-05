<a class="nav-item no-hover-text-decor container-fluid d-md-none" href="{{ route('login') }}">
    <li class="nav-link no-hover-text-decor text-white d-flex  {{ startsWith(request()->url(), route('login')) ? 'active' : '' }}">
        <span class="material-icons-outlined pr-2 my-auto">power_settings_new</span>
        <span class="d-inline-block my-auto">Login {!! request()->url() == route('login') ? '<span class="sr-only">(current)</span>' : '' !!}</span>
    </li>
</a>