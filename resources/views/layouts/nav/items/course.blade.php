<a class="nav-item no-hover-text-decor container-fluid d-md-none" href="{{ route('course.index') }}">
    <li class="nav-link no-hover-text-decor text-white d-flex  {{ startsWith(request()->url(), route('course.index')) ? 'active' : '' }}">
        <span class="material-icons-round pr-2 my-auto">menu_book</span>
        <span class="d-inline-block my-auto">Courses {!! request()->url() == route('login') ? '<span class="sr-only">(current)</span>' : '' !!}</span>
    </li>
</a>