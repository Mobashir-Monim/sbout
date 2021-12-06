<a class="nav-item no-hover-text-decor container-fluid" href="{{ route('course.index') }}">
    <li class="nav-link no-hover-text-decor text-white d-flex  {{ startsWith(request()->url(), route('course.index')) ? 'active' : '' }}">
        <span class="material-icons-round pr-2 my-auto">local_library</span>
        <span class="d-inline-block my-auto">Enrolled {!! request()->url() == route('login') ? '<span class="sr-only">(current)</span>' : '' !!}</span>
    </li>
</a>