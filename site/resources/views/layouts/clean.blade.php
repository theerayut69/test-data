<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

    <link rel="icon" href="/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Basketball') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/aspire/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
    <div id="app">
        <div class="app">
            <div class="layout">
                <!-- Side Nav START -->
                <div class="side-nav">
                    <div class="side-nav-inner">
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
                            <li class="nav-item dropdown open">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="ti-package"></i>
                                    </span>
                                    <span class="title">All Teams</span>
                                    <span class="arrow">
                                        <i class="ti-angle-right"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                @if($menuLeagues)
                                    @foreach($menuLeagues as $league)
                                        <li class="nav-item dropdown open">
                                            <a class="dropdown-toggle" href="javascript:void(0);">
                                                <span class="icon-holder">
                                                    <i class="ti-basketball"></i>
                                                </span>
                                                <span class="title">{{ $league->name }}</span>
                                                <span class="arrow">
                                                    <i class="ti-angle-right"></i>
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if($menuTeams)
                                                    @foreach($menuTeams as $team)
                                                        @if($league->id == $team->league_id)
                                                            <li>
                                                                <a href="{{ url('team/' . $team->id . '/view') }}">{{ $team->name }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                                    
                                </ul>
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
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://themenate.com/espire/html/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('/js/aspire/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

</body>

</html>