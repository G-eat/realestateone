<div class="site-wrap">
    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

    <div class="site-navbar mt-4">
        <div class="container py-1">
            <div class="row align-items-center">
                <div class="col-8 col-md-8 col-lg-4">
                    <h1 class="mb-0"><a href="{{ route('article.all') }}" class="text-white h2 mb-0"><strong>Real Estate One<span class="text-danger">.</span></strong></a></h1>
                </div>
                <div class="col-4 col-md-4 col-lg-8">
                    <nav class="site-navigation text-right text-md-right" role="navigation">
                        <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
                        <ul class="site-menu js-clone-nav d-none d-lg-block">
                            <li class="{{ (Route::current()->getName() == 'article.all') ? 'active' : '' }}">
                                <a href="{{ route('article.all') }}">Home</a>
                            </li>
                            <li class="{{ (Route::current()->getName() == 'aboutus') ? 'active' : '' }}">
                                <a href="{{ route('aboutus') }}">About</a>
                            </li>
                            <li class="{{ (Route::current()->getName() == 'contactus') ? 'active' : '' }}">
                                <a href="{{ route('contactus') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
