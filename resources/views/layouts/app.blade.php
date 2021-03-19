<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title>AppUI - Web App Bootstrap Admin Template</title>

    <meta name="description"
        content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/img/favicon.png">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/img/icon180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/themes.css">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="js/vendor/modernizr-3.3.1.min.js"></script>
</head>

<body>
    <!-- Page Wrapper -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
    <div id="page-wrapper" class="page-loading">
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
        <div class="preloader">
            <div class="inner">
                <!-- Animation spinner for all modern browsers -->
                <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                <!-- Text for IE9 -->
                <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
            </div>
        </div>
        <!-- END Preloader -->

        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
                Available #page-container classes:

                'sidebar-light'                                 for a light main sidebar (You can add it along with any other class)

                'sidebar-visible-lg-mini'                       main sidebar condensed - Mini Navigation (> 991px)
                'sidebar-visible-lg-full'                       main sidebar full - Full Navigation (> 991px)

                'sidebar-alt-visible-lg'                        alternative sidebar visible by default (> 991px) (You can add it along with any other class)

                'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
                'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

                'fixed-width'                                   for a fixed width layout (can only be used with a static header/main sidebar layout)

                'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links (You can add it along with any other class)
            -->
        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
                <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
                <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i
                        class="fa fa-times"></i></a>

                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll-alt">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Profile -->
                        <div class="sidebar-section">
                            <h2 class="text-light">Profile</h2>

                        </div>
                        <!-- END Profile -->

                        <!-- Settings -->

                        <!-- END Settings -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
            @include('layouts.sidebar')
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <header class="navbar navbar-inverse navbar-fixed-top">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- END Left Header Navigation -->
                </header>

                <div id="page-content">
                    <!-- END Header -->

                    @yield('content-header')

                    <!-- Page content -->
                    @yield('content')
                    <!-- END Page Content -->

                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="{{ asset('admin') }}/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="{{ asset('admin') }}/js/vendor/bootstrap.min.js"></script>
        <script src="{{ asset('admin') }}/js/plugins.js"></script>
        <script src="{{ asset('admin') }}/js/app.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="{{ asset('admin') }}/js/pages/readyDashboard.js"></script>
        <script>
            $(function() {
                ReadyDashboard.init();
            });

        </script>
</body>

</html>
