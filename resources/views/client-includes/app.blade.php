 <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>@yield('title')</title>
            @include('client-includes.header')
        </head>
        <body>

            @auth
                <nav class="navbar" id="navbar-fixed" style="background: #3c8dbc;">
                    <div class="container">
                        <a href="{{ route('home') }}" class="text-white">
                            AdminPannel
                        </a>
                        <a href="{{ route('logout') }}" class="text-white">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </nav>
            @endauth

            <div class="site-loader"></div>

            @include('client-includes.navbar')

            @yield('navbar_background')

            @yield('search')

            @yield('content')

            @include('client-includes.footer')

            @include('client-includes.javascript')

            <script>
                var elementPosition = $('#navbar-fixed').offset();

                $(window).scroll(function(){
                    if($(window).scrollTop() > elementPosition.top){
                        $('#navbar-fixed').addClass('fixed-top');
                    } else {
                        $('#navbar-fixed').removeClass('fixed-top');
                    }
                });
            </script>
        </body>
    </html>
