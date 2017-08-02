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
                font-weight: 400;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            /*.flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }*/

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 40px;
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

            @media screen and (min-width: 480px) {
                .title {
                    font-size: 70px;
                }
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="row">
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
            </div>

            <div class="container">
                <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="content">
                            <div class="title">
                                Community<span>Crit</span>
                            </div>
                            <div class="body desc-text">
                                <p><b>CommunityCrit allows the public to participate in the urban design process.</b> By offering a quick and easy way to voice opinions, CommunityCrit empowers anyone to help shape the future of their community. By collecting ideas from anyone, anywhere, at any time, CommunityCrit enables organizers to engage their community in the development of planning proposals.</p>
                                <p>Currently, community leaders are collaborating with the public and local experts to design the intersection of 14th Street and National Avenue, called <strong>“El Nudillo.”</strong> The future El Nudillo is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                                <p><strong>We would love to hear your thoughts!</strong></p>
                                <a type="button" class="btn btn-primary btn-lg" style="margin-top: 10px;" href="{{ route('register') }}">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
