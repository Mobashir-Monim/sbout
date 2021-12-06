<a class="nav-item no-hover-text-decor container-fluid" href="{{ route('home') }}">
    <li class="nav-link no-hover-text-decor text-white d-flex  {{ startsWith(request()->url(), route('home')) ? 'active' : '' }}">
        <span class="material-icons-round pr-2 my-auto">dashboard</span>
        <span class="d-inline-block my-auto">Dashboard {!! request()->url() == route('home') ? '<span class="sr-only">(current)</span>' : '' !!}</span>
    </li>
</a>