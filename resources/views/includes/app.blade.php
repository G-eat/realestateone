 <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>@yield('title')</title>
            @include('includes.header')
        </head>
        <body>

            <div class="site-loader"></div>

            @include('includes.navbar')

            @yield('navbar_background')

            @yield('search')

            @yield('content')

            @include('includes.footer')

            @include('includes.javascript')

        </body>
    </html>
