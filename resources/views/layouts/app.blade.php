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
    @include("utilities.analytics")

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
                        <li><a href="{{ route('do') }}">Do An Activity</a></li>
                        {{--<li><a href="{{ route('submit-idea') }}">Submit an Idea</a></li>--}}
                    @endif
                    {{--<li><a href="{{ url('overview') }}">Overview</a></li>--}}
                    <li><a href="{{ route('ideas') }}">Ideas</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/my-contributions') }}">My Contributions <span class="badge">{{ auth()->user()->submitted }}</span></a></li>
{{--                        <li><a href="{{ action('TaskController@index') }}">Tasks</a></li>--}}
                        @if (Auth::user()->admin)
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                Moderation <span class="badge" style="{{ $modData[1] ? 'background-color: #b94a48;' : '' }}">{{ $modData[0]->sum() }}</span> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ action('AdminController@showUpdateByStatus', 0) }}">Pending <span class="badge">{{ $modData[0][0] }}</span>
                                    @if ($modData[1])
                                        <span class="badge" style="background-color: #b94a48;">{{ $modData[1] }}</span>
                                    @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@showUpdateByStatus', 1) }}">Approved <span class="badge">{{ $modData[0][1] }}</span></a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@showUpdateByStatus', 2) }}">Rejected <span class="badge">{{ $modData[0][2] }}</span></a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@showUpdateByStatus', 3) }}">Postponed <span class="badge">{{ $modData[0][3] }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                                Admin <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ action('AdminController@showUserSummary') }}">Users Summary</a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@showSubmissionSummary') }}">Submissions Summary</a>
                                </li>
                                <li>
                                    <a href="{{action('AdminController@showIdeaNames')}}">Idea Names</a>
                                </li>
                                <li>
                                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Backpack</a>
                                </li>
                            </ul>
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

    @yield('structured-content')
    <div class="container pad bot">
        @include('flash::message')
        @yield('content')
    </div>
    <div class="footer print-none">
        <div class="center">
            <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/activities.js') }}"></script> -->
<script>
    $( document ).ready(function() {
        // $('#waiting').hide();
        var speed = 400;
        $('.activity #question').fadeTo(speed, 1);
        $('.activity #detail').delay(speed).fadeTo(speed, 1);

        //for use in activities\elaboration
        $("#photosub").change(function () {
            var photosub = document.getElementById("photosub");
            var extrasub = document.getElementById("extrasub");
            var extradiv = document.getElementById("extradiv");
            if (photosub && photosub.value) {
                extradiv.style.display = 'block';
                extrasub.style.display = 'inline';
            }
            else {
                extradiv.style.display = 'none';
                extrasub.value = null;
                extrasub.style.display = 'none';
            }
        });

    });

    $('#guest-button').click(function(){
        $('[required]').removeAttr('required');
        $('#consent').prop('required', true);
    });

    $('#submit-button').click(function() {
        $(this).hide();
        $('#skip').hide();
    });

    var visible = false;
    function overview_onClick() {
        visible = !visible;
        var text = (visible) ? 'hide' : 'show';
        $('#overview-btn-instr').text(text);
    }

    //focus handler
    var Status = {};

    var focusHandler = function() {
        var name = this.name;
        console.log("Focus", name, Status[name]);
        if (!Status[name]) Status[name] = {
            total: 0,
            focus: Date.now()
        };
        else Status[name].focus = Date.now();
    };
    var blurHandler = function() {
        var name = this.name;
        if (Status[name]) {
            Status[name].total += Date.now() - Status[name].focus;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/ajax/timer',
            @if ( !empty($task) && !empty($idea) && !empty($link) && !empty($ques))
                data: {'_token' : "{{csrf_token()}}", 'timers' : Status, 'task' : "{{$task->id}}", 'idea' : "{{$idea->id}}", 'link' : "{{$link->id}}", 'ques' : "{{$ques->id}}" },
            @else
                data: {'_token' : "{{csrf_token()}}", 'timers' : Status},
            @endif
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }

        });
    };

    var r_ptr = 0;

    var refresherHandler = function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/ajax/ideas',
            data: {'_token' : "{{csrf_token()}}", 'i_ptr' : r_ptr },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                r_ptr += 1;
                console.log(r_ptr);

                for (var i = 0; i < data.length; i++) {
                    var name_str = "idea-name-" + i;
                    var link_str = "idea-link-" + i;
                    var name = document.getElementById(name_str);
                    var link = document.getElementById(link_str);
                    link.href = "{{ action( 'TaskController@showRandomTask') }}" + "/" + data[i].id;
                    name.innerHTML = data[i].name;
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    };

    // You don't have to attach them this way, it's just for example

    var inputs = document.getElementsByTagName('textarea');

    for (var i = 0, l = inputs.length; i < l; i++) {
        inputs[i].onfocus = focusHandler;
        inputs[i].onblur = blurHandler;
    }

    var refresher = document.getElementById('refresher');
    if (refresher)
        refresher.onclick = refresherHandler;

    var hide_me = document.getElementById('submit-button');
    if (hide_me)
        hide_me.onclick = hide_submit();

</script>
</body>
</html>
