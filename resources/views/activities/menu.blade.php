@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    <div id="main-menu">
        <h1>Do An Activity</h1>
        <p>Please select an option below to begin contributing.</p>


        <h2>Pick an Idea to Work On</h2><p>Here are three random ideas that were submitted by community members. Select one to complete five activities related to that idea. You are always free to skip activities, and you can switch to a different idea by coming back to this Do An Activity Page at any time.</p>
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

        <h2>Have an idea?</h2><p>Click here to submit your own idea for the future of El Nudillo.</p>
        <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
            Submit a New Idea
        </a>

        <h2>All done?</h2><p>Please take this survey when you are done contributing. Your feedback will help us make changes to CommunityCrit so it can better serve communities in the urban design process.</p>
        <a class="btn btn-primary" href="{{ route( 'exit') }}">
            Go to Exit Survey
        </a>
    </div>
@endsection
