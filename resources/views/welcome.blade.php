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

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            .desc-text {
                font-size: 125%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
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

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="content">
                        <div class="title m-b-md">
                            Community<span>Crit</span>
                        </div>
                        <div class="body desc-text text-center" style="padding-left:180px; padding-right:180px">
                            <p><b>CommunityCrit allows the public to participate in the urban design process.</b> By offering a quick and easy way to voice opinions, CommunityCrit empowers anyone to help shape the future of their community. And by collecting ideas from anyone, anywhere, at any time, CommunityCrit provides city planners with the feedback they need to develop great planning proposals.</p>
                            <p>Currently, community leaders are engaging the public and local experts to design a portion of the 14th Street Promenade called “El Nudillo.” El Nudillo—the intersection of 14th Street and National Avenue—is imagined to become a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                            <p>We would love to hear your thoughts!</p>
                            <a type="button" class="btn btn-primary" style="margin-top: 10px;" href="{{ route('register') }}">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
