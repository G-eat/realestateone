 <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>@yield('title')</title>
            @include('../include/header')
        </head>
        <body>

            <div class="site-loader"></div>

            @include('../include/navbar')

            @yield('navbar_background')

            @yield('search')

            @yield('content')

            @include('../include/footer')

            @include('../include/javascript')

        </body>
    </html>
