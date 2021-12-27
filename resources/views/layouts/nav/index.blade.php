<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            @include('layouts.nav.items.course')

            @auth
                @include('layouts.nav.items.dashboard')
                @include('layouts.nav.items.enrolled')
                @include('layouts.nav.items.config')
                @include('layouts.nav.items.logout')
            @else
                @include('layouts.nav.items.login')
            @endauth
        </ul>
    </div>
</nav>