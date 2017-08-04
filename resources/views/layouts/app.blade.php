<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CommunityCrit') | CommunityCrit</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'CommunityCrit') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                        &nbsp;
                    @else
                        <!-- <li><a href="{{ route('ideas') }}">Ideas</a></li> -->
                        {{--<li><a href="{{ url('/overview') }}">Overview</a></li>--}}
                        {{--<li><a href="{{ action('TaskController@allFacets') }}">Topics</a></li>--}}
                        {{--<li><a href="{{ action('TaskController@allSources') }}">Sources</a></li>--}}
                        {{--<li class="dropdown"><a href="sources.htm" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">Sources<span class="caret"></span></a>--}}
                        {{--<ul role="menu" class="dropdown-menu">--}}
                        {{--<li><a href="source-detail.htm">14th Street Promenade Master Plan</a></li>--}}
                        {{--<li><a href="source-detail.htm">East Village South Focus Plan</a></li>--}}
                        {{--</ul>--}}
                    @endif
                    <li><a href="{{ url('/about') }}">About</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/my-contributions') }}">My Contributions <span class="badge">{{ $myFeedbackCount }}</span></a></li>
{{--                        <li><a href="{{ action('TaskController@index') }}">Tasks</a></li>--}}
                        @if(Auth::user()->admin)
                            <li>
                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Admin</a>
                            </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/activities.js') }}"></script> -->
<script>
    function btntest_onclick() 
    {
        if ($('.activity #idea').length > 0) {
            $('#task-panel').delay(1000).fadeTo(500, 1);
            $('.activity #idea').delay(500).fadeTo(500, 0, function() {
                $('#waiting').show();
                window.location.assign("{{ route('do')}}");
            });
        }
        else {
            $('#task-panel').fadeTo(500, 0, function() {
                $('#waiting').show();
                window.location.assign("{{ route('do')}}");
            });
        }
    }

    $( document ).ready(function() {
        $('#waiting').hide();
        $('.activity #idea').fadeTo(500, 1);
        $('#task-panel').delay(500).fadeTo(500, 1);
    });
</script>
</body>
</html>
