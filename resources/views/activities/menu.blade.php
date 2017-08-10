@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    <div id="main-menu">
        <h1>Do An Activity</h1>
        <p>Please select an option below to begin contributing.</p>

        <section>
            <h2>Pick an Idea to Work On</h2>
            <p>Select an idea below to complete five activities related to that idea. You are always free to skip activities, and you can switch to a different idea by going back to the main menu at any time.</p>
            <div class="row">
                @foreach ($ideas as $idea)
                    <div class="col-sm-6 col-md-4">
                        <a class="panel-link" href="{{ action( 'TaskController@showRandomTask', $idea->id) }}">
                            <div class="panel panel-default">
                                <div class="panel-body lg">
                                    @if ($idea->name)
                                        {{$idea->name}}
                                    @endif
                                </div>
                            </div> <!-- .panel -->
                        </a>
                    </div> <!-- .col -->
                @endforeach
            </div>
        </section>

        <section>
            <h2>Have an idea?</h2>
            <p>Click here to submit your own idea for the future of El Nudillo.</p>
            <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
                Submit a New Idea
            </a>
        </section>

        @if ((count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 3)) >= 5)
            <section>
                <h2>All done?</h2>
                <p>Help us improve this tool by taking a short survey so more voices like yours may contribute to urban planning projects.</p>
                <a class="btn btn-primary" href="{{ route( 'exit') }}">
                    Go to Exit Survey
                </a>
            </section>
        @endif
        </div>

    </div>
@endsection
