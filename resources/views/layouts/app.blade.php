<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="../css/adminstyle.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="../css/toastr.min.css" rel="stylesheet"/>

</head>
<body>

<!--===================
   Header
   =======================-->
    <header class="header">
        <nav class="navbar navbar-toggleable-md navbar-light pt-0 pb-0">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
                <a class="button-left pt-2 pb-2" style="color: white;text-decoration: none; cursor: pointer"><span class="fa fa-fw fa-bars mr-2"></span>AdminPannel</a>
            @else
                <a class="button-left pt-2 pb-2" style="color: white;text-decoration: none;">AdminPannel</a>
            @endauth
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link in" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" >
                        {{ __('Logout') }}
                    </a>
                </li>
            @endguest
            </ul>
        </nav>
    </header>

    <div class="main" style="display: flex">
        @auth
            <aside>
                <div class="sidebar left ">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="http://via.placeholder.com/160x160" class="rounded-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>bootstrap develop</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <ul class="list-sidebar bg-defoult">
                        <li> <a href="{{ route('home') }}" class="collapsed active"> <i class="fa fa-th-large"></i> <span class="nav-label"> Dashboards </span></a></li>
                        <li> <a href="{{ route('all_articles') }}"><i class="fa fa-eye"></i> <span class="nav-label">See Page</span></a> </li>
                        <li> <a href="{{ route('admin.articles') }}" class="collapsed active"><i class="fa fa-table"></i> <span class="nav-label">Articles</span></a> </li>
                        <li> <a href="{{ route('admin.contactus') }}"><i class="fa fa-envelope"></i> <span class="nav-label">Contacts</span></a> </li>
                        <li> <a href="{{ route('admin.aboutus') }}" class="collapsed active"><i class="fa fa-info"></i> <span class="nav-label">AboutUs Content</span></a> </li>
                    </ul>
                </div>
            </aside>
        @endauth
        <div id="app" style="flex: 1;">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.javascript')

    </body>
</html>
