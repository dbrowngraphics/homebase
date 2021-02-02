<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div id="page-logo" class="page-logo" style="padding: 0; height: auto">
        <div  style="height: 100%; width: 100%; background-color: #cacaca; paddding: 0 2rem;">
            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
                <img src="{{ asset('img/Homebase-Full-Logo.png') }}" alt="Homebase Full Logo" aria-roledescription="logo" style="max-width: 100%; padding: 0.5rem; margin: auto;">
            </a>
        </div>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">

        @include('layouts._menu.menu')

        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
</aside>
<!-- END Left Aside -->