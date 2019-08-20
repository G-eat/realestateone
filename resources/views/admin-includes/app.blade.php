<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="../css/toastr.min.css" rel="stylesheet"/>
{{--    <link href="{{ asset('toastr/css/toastr.css') }}" rel="stylesheet"/>--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

</head>
<body>

<!--===================
   Header
   =======================-->
    <header class="header">
        <nav class="navbar navbar-toggleable-md navbar-light pt-0 pb-0">
            @auth
                @can('admin')
                    <a class="button-left pt-2 pb-2" style="color: white;text-decoration: none; cursor: pointer"><span class="fa fa-fw fa-bars mr-2"></span>AdminPannel</a>
                @elsecan('user')
                    <a class="button-left pt-2 pb-2" style="color: white;text-decoration: none; cursor: pointer"><span class="fa fa-fw fa-bars mr-2"></span>UserPannel</a>
                @else
                    <a class="button-left pt-2 pb-2" style="color: white;text-decoration: none; cursor: pointer"><span class="fa fa-fw fa-bars mr-2"></span>Pannel</a>
                @endcan
            @else
                <a style="color: white;text-decoration: none;">Pannel</a>
            @endauth
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'login' ? 'in' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'register' ? 'in' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                            <p>{{ Auth::user()->name }}</p>
                            <a>{{ Auth::user()->email }}</a>
                        </div>
                    </div>
                    <ul class="list-sidebar bg-defoult">
                        <li> <a href="{{ route('home') }}" class="collapsed active"> <i class="fa fa-th-large"></i> <span class="nav-label"> Dashboards </span></a></li>
                        @can('admin')
                            <li> <a href="{{ route('article.all') }}"><i class="fa fa-eye"></i> <span class="nav-label">ClientSide</span></a> </li>
                            <li> <a href="{{ route('articles') }}" class="collapsed active"><i class="fa fa-table"></i> <span class="nav-label">Articles</span></a> </li>
                            <li> <a href="{{ route('admin.contactus') }}"><i class="fa fa-envelope"></i> <span class="nav-label">Contacts</span></a> </li>
                            <li> <a href="{{ route('admin.aboutus') }}" class="collapsed active"><i class="fa fa-info"></i> <span class="nav-label">AboutUs Content</span></a> </li>
                        @else
                            <li> <a href="{{ route('article.all') }}"><i class="fa fa-eye"></i> <span class="nav-label">AllArticles</span></a> </li>
                            <li> <a href="{{ route('articles') }}" class="collapsed active"><i class="fa fa-table"></i> <span class="nav-label">MyArticles</span></a> </li>
                        @endcan
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

    @include('admin-includes.javascript')

    </body>
</html>
