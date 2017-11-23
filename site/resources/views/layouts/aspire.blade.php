<!DOCTYPE html>
<html>


<!-- Mirrored from themenate.com/espire/html/dist/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Nov 2017 03:16:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

    <link rel="icon" href="/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Basketball') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ mix('/css/app.css') }}" rel="stylesheet"> -->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- plugins css -->
    <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/bootstrap/dist/css/bootstrap.css" />
    {{--  <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />  --}}
    <link href="{{ asset('/css/aspire/font-awesome.min.css') }}" rel="stylesheet">
    {{--  <link href="https://raw.githubusercontent.com/wgbbiao/bootstrap4-datetimepicker/master/build/css/bootstrap-datetimepicker.css" rel="stylesheet">  --}}

    <!-- page plugins css -->
    {{--  <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="http://themenate.com/espire/html/bower_components/nvd3/build/nv.d3.min.css" />  --}}

    <!-- core css -->
    <link href="{{ asset('/css/aspire/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/aspire/ei-icon.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/aspire/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/aspire/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/aspire/app.css') }}" rel="stylesheet">
    {{--  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">  --}}
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div class="app">
            <div class="layout">
                <!-- Side Nav START -->
                <div class="side-nav">
                    <div class="side-nav-inner">
                        <div class="side-nav-logo">
                            <a href="index-2.html">
                                <div class="logo logo-dark" style="background-image: url('assets/images/logo/logo.png')"></div>
                                <div class="logo logo-white" style="background-image: url('assets/images/logo/logo-white.png')">Basketball</div>
                            </a>
                            <div class="mobile-toggle side-nav-toggle">
                                <a href="#">
                                    <i class="ti-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                        <ul class="side-nav-menu scrollable">
                            <li class="nav-item active">
                                <a class="mrg-top-30" href="{{ url('/') }}">
                                    <span class="icon-holder">
                                        <i class="ti-basketball"></i>
                                    </span>
                                    <span class="title">Home</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="mrg-top-30" href="{{ url('league') }}">
                                    <span class="icon-holder">
                                        <i class="ti-layout-grid3"></i>
                                    </span>
                                    <span class="title">League</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="mrg-top-30" href="{{ url('team') }}">
                                    <span class="icon-holder">
                                        <i class="ti-view-list-alt"></i>
                                    </span>
                                    <span class="title">Team</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="mrg-top-30" href="{{ url('player') }}">
                                    <span class="icon-holder">
                                        <i class="ti-face-smile"></i>
                                    </span>
                                    <span class="title">Player</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="mrg-top-30" href="{{ url('fixture') }}">
                                    <span class="icon-holder">
                                        <i class="ti-layout-column2"></i>
                                    </span>
                                    <span class="title">Fixture</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Side Nav END -->

                <!-- Page Container START -->
                <div class="page-container">
                    <!-- Header START -->
                    <div class="header navbar">
                        <div class="header-container">
                            <ul class="nav-left">
                                <li>
                                    <a class="side-nav-toggle" href="javascript:void(0);">
                                        <i class="ti-view-grid"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                
                            </ul>
                        </div>
                    </div>
                    <!-- Header END -->

                    <!-- Content Wrapper START -->
                    <div class="main-content">
                        <!-- <div class="container-fluid">
                            <div class="row">
                                
                            </div>
                        </div> -->
                        @yield('content')
                    </div>
                    <!-- Content Wrapper END -->

                    <!-- Footer START -->
                    <footer class="content-footer">
                        <div class="footer">
                            <div class="copyright">
                                <span>Copyright © 2017 <b class="text-dark">Basketball</b>. All rights reserved.</span>
                                <span class="go-right">
                                        <a href="#" class="text-gray mrg-right-15">Term &amp; Conditions</a>
                                        <a href="#" class="text-gray">Privacy &amp; Policy</a>
                                    </span>
                            </div>
                        </div>
                    </footer>
                    <!-- Footer END -->

                </div>
                <!-- Page Container END -->

            </div>
        </div>
    </div>
    

    <script src="{{ asset('/js/aspire/vendor.js') }}"></script>

    <!-- page plugins js -->
    <script src="http://themenate.com/espire/html/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ asset('/js/aspire/maps/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="http://themenate.com/espire/html/bower_components/d3/d3.min.js"></script>
    <script src="http://themenate.com/espire/html/bower_components/nvd3/build/nv.d3.min.js"></script>
    <script src="http://themenate.com/espire/html/bower_components/jquery.sparkline/index.js"></script>
    <script src="http://themenate.com/espire/html/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://themenate.com/espire/html/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

    <script src="{{ asset('/js/aspire/app.min.js') }}"></script>

    <!-- page js -->
    <script src="{{ asset('/js/aspire/dashboard/dashboard.js') }}"></script>
    <script src="{{ asset('/js/aspire/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('/js/page.js') }}"></script>

</body>

</html>