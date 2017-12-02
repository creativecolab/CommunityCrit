<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CommunityCrit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @include("utilities.analytics")
    </head>
    <body id="welcome">
        <div class="position-ref full-height half bkg-img bkg-img-ht">
        </div>
        <div class="position-ref full-height half">
            <!-- <div class="row">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    </div>
                @endif
            </div> -->

            <!-- <div class="container"> -->
            <div id="content" class="pad">
                <h1>CommunityCrit allows <span class="accent">the PUBLIC</span> to participate in the urban design process.</h1>
                <div class="desc-text">
                    <p>By offering a quick and easy way to voice opinions, CommunityCrit empowers anyone to help shape the future of their community.</p>
                    <p>Currently, we are collecting feedback on an effort to expand the 14th Street Promenade in East Village. The intersection of 14th Street, National Avenue, and Commercial Street—referred to as “El Nudillo,” or “the knuckle”—is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                    <p><strong>What do you think El Nudillo should be?</strong> Please click below to contribute your voice!</p>

                    <a type="button" class="btn btn-primary btn-lg" style="margin-top: 10px;" href="{{ route('register') }}">Get Started</a>
                </div>
            </div>
        </div>
        
    </body>
</html>
