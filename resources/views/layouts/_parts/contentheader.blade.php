<!-- BEGIN Page Header -->
<header id="page-header" class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('img/Homebase-Full-Logo.png') }}" alt="CWI Full Logo" aria-roledescription="logo">
            <span class="page-logo-text mr-1">CWI FULL LOGO</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="btn press-scale-down btn-primary" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>

    <div class="container-fluid">
        <div class="row" style="height: 89.983px !important;">
            <div class="col col-lg-9 offset-lg-1">
                @yield('header-bar')
            </div>

            <div class="col-lg-2">
                <div class="ml-auto d-flex" style="float: right;">
                    
                    @auth
                        <div class="top-right links" style="float: left">
                                <a class="header-icon" href="{{ url('/home') }}">Home</a>
                        </div>
                        <div class="top-right links" style="float: left">
                                <a class="header-icon" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        
                        </div>
                     @else
                        <div class="top-right links">
                            <a class="header-icon" href="{{ route('login') }}">Login</a>
                        </div>
                    @endauth
                    

                    <!-- app settings -->
                    <div class="hidden-sm-down">
                        <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                            <i class="fal fa-cog"></i>
                        </a>
                    </div>

                </div>

            </div> <!-- END .col-lg-3 -->
        </div> <!-- END .row -->
    </div> <!-- END .container -->
</header>
<!-- END Page Header -->