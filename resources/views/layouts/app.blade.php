<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-style.css') }}" rel="stylesheet">
    @yield('links')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            
            @auth
                <span class="navbar-brand col-md-3 col-lg-2 mr-0 px-3">
                    <i class="fas fa-list text-white pr-3 d-md-none" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"></i>
                    <i class="fas fa-list ml-5 text-white pr-3 d-none d-md-inline-block" type="button" onclick="toggleSideNav()"></i>
                    <a class="text-white d-md-none" href="{{ route('home') }}">SBout</a>
                    <a class="text-white d-none d-md-inline-block" href="{{ route('home') }}">SBout</a>
                </span>
                
                <ul class="navbar-nav pr-5 py-1 d-none d-md-block">
                    <li class="nav-item float-right mx-3">
                        <a class="nav-link d-flex align-items-center" href="#/" onclick="document.getElementById('logout-form').submit()">
                            <span class="material-icons-outlined mr-2">power_settings_new</span>
                            <span>Logout</span>
                        </a>
                    </li>
                    <li class="nav-item float-right mx-3">
                        <a class="nav-link d-flex align-items-center {{ startsWith(request()->url(), route('course.index')) ? 'active' : '' }}" href="{{ route('course.index') }}">
                            <span class="material-icons-round mr-2">menu_book</span>
                            <span>Courses</span>
                        </a>
                    </li>
                </ul>
            @else
                <span class="navbar-brand col-md-3 col-lg-2 mr-0 px-3">
                    <span class="ml-5 text-white pr-3 d-none d-md-inline-block" style="width: 32px"></span>
                    <i class="fas fa-list text-white pr-3 d-md-none" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"></i>
                    <a class="text-white" href="/">SBout</a>
                </span>
                
                <ul class="navbar-nav pr-5 py-1 d-none d-md-block">
                    <li class="nav-item float-right mx-3">
                        <a class="nav-link d-flex align-items-center {{ startsWith(request()->url(), route('login')) ? 'active' : '' }}" href="{{ route('login') }}">
                            <span class="material-icons-outlined mr-2">power_settings_new</span>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="nav-item float-right mx-3">
                        <a class="nav-link d-flex align-items-center {{ startsWith(request()->url(), route('course.index')) ? 'active' : '' }}" href="{{ route('course.index') }}">
                            <span class="material-icons-round mr-2">menu_book</span>
                            <span>Courses</span>
                        </a>
                    </li>
                </ul>
            @endauth
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                    @include('layouts.nav.index')

                    <main role="main" class="col-md-9 col-lg-10 ml-sm-auto px-md-4 pt-4" id="main">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12" id="flash-zone">
                                    @include('flash::message')
                                </div>
                            </div>
                            @yield('content')
                        </div>
                    </main>
                @else
                    <main role="main" class="col-md-12 col-lg-12 ml-sm-auto px-md-4 pt-4" id="main">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12" id="flash-zone">
                                    @include('flash::message')
                                </div>
                            </div>
                            @yield('content')
                        </div>
                    </main>
                @endauth
                
            </div>
        </div>

        {{-- <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main> --}}
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    @yield('scripts')

    <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf
    </form>
</body>
</html>
