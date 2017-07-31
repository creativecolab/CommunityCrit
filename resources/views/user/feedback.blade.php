@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
    <h1>My Contributions</h1>

    <h2>Submitted Ideas <span class="badge">{{count($ideas)}}</span></h2>
    @if (!count($ideas))
        <h4>You have not submitted any ideas yet.</h4>
        <a href="{{ route('do') }}">Submit an Idea</a>
    @endif

    <div class="row">
        @foreach ($ideas as $idea)
            <div class="col-sm-6 col-lg-4">
                <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">{{ $idea->name }}</div>
                        </div> <!-- .panel-heading -->
                        <div class="panel-body">
                            {{ $idea->text }}
                        </div> <!-- .panel-body -->
                    </div> <!-- .panel -->
                </a>
            </div> <!-- .col -->
        @endforeach
    </div>

    <h2>Improvements, Critiques, and Assessments <span class="badge">{{count($feedbacks)}}</span></h2>
    @if (!count($feedbacks))
        <h4>You have not submitted feedback yet.</h4>
        <a href="{{ route('do') }}">Get Started</a>
    @endif

    <div class="row">
        @foreach ($feedbacks as $feedback)
            <div class="col-sm-6 col-lg-4">
                <!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $feedback->id) }}"> -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Idea: Build a tower</div>
                            Build a tower in the center of the intersection.
                        </div> <!-- .panel-heading -->
                        <div class="panel-body">
                            <strong>Improve an Idea {{--!! $feedback->task->name !!--}}</strong></br>
                            Improve the current idea by suggesting changes or additions that support the reference. {{--!! $feedback->task->text !!--}}
                        </div> <!-- .panel-body -->
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Reference: Project Goal</strong><br>
                                Create a memorable and major public open space or series of open spaces to anchor an “innovation district.” Pocket parks and/or green spaces must punctuate the neighborhood.
                            </li>
                            <li class="list-group-item">
                                {!! $feedback->comment !!}
                            </li>
                            <li class="list-group-item">
                                {!! $feedback->created_at !!}
                            </li>
                        </ul>
                    </div> <!-- .panel -->
                <!-- </a> -->
            </div> <!-- .col -->
        @endforeach
    </div>

@endsection