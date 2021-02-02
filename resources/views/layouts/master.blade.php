@include('layouts._parts.header')

<body class="mod-bg-1 ">

    @include('layouts._parts.beginscript')

        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">

                <!-- Put sidebar - aside here -->
                @include('layouts._parts.sidebar')

                <div class="page-content-wrapper">

                    @include('layouts._parts.contentheader')

                    @include('layouts._parts.content')

                    @include('layouts._parts.footer')

                    <!-- @ include('layouts._parts.modalshortcuts') -->

                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->

        <!-- @ include('layouts._parts.quickmenu') -->

        <!-- @ include('layouts._parts.messenger') -->

        <!-- @ include('layouts._parts.pagesettings') -->

        @include('layouts._parts.scripts')


    @stack('scripts')

</body>
</html>