@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
    <h1>My Contributions</h1>

    <h2>Submitted Ideas <span class="badge">{{count($ideas)}}</span></h2>
    @if (!count($ideas))
        <h4>You have not submitted any ideas yet.</h4>
        <a href="{{ route('submit-idea') }}">Submit an Idea</a>
    @endif

    <div class="row">
        @foreach ($ideas as $idea)
            <div class="col-md-12">
            <!-- <div class="col-sm-6 col-lg-4"> -->
                <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                    <div class="panel panel-default">
                        @if ($idea->name)
                            <div class="panel-heading">
                                <div class="panel-title">{{ $idea->name }}</div>
                            </div> <!-- .panel-heading -->
                        @endif
                        <div class="panel-body">
                            {{ $idea->text }}
                        </div> <!-- .panel-body -->
                        <div class="panel-footer">
                            {!! $idea->readableDate($idea->created_at) !!}
                        </div>
                    </div> <!-- .panel -->
                </a>
            </div> <!-- .col -->
        @endforeach
    </div>

    <h2>References <span class="badge">{{count($links)}}</span></h2>
    @if (!count($links))
        <h4>You have not submitted any references yet.</h4>
        <!-- <a href="{{ route('do') }}">Get Started</a> -->
    @endif

    <div class="row">
        @foreach ($links as $link)
            <div class="col-md-12">
            <!-- <div class="col-sm-6 col-lg-4"> -->
                <!-- <a class="panel-link"> -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                @component('utilities.link_type_name', ['link_type' => $link->link_type])
                                @endcomponent
                            </div>
                        </div> <!-- .panel-heading -->
                        <div class="panel-body">
                            {!! $link->text !!}
                        </div>
                        <div class="panel-footer">
                            {{ $link->created_at }}
                        </div>
                    </div> <!-- .panel -->
                <!-- </a> -->
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
            <div class="col-md-12">
            <!-- <div class="col-sm-6 col-lg-4"> -->
                <!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $feedback->id) }}"> -->
                    <div class="panel panel-default">
                        @if ($feedback->idea)
                            <div class="panel-heading">
                                <div class="panel-title">Idea: {{ $feedback->idea->name }}</div>
                                {{ $feedback->idea->text }}
                            </div> <!-- .panel-heading -->
                        @endif
                        <ul class="list-group">
                            @if ($feedback->task)
                                <li class="list-group-item">
                                    <strong>{{$feedback->task->name}}</strong></br>
                                    {!! $feedback->task->text !!}
                                </li>
                            @endif
                            @if ($feedback->link)
                                <li class="list-group-item">
                                    <strong>Reference: 
                                        @component('utilities.link_type_name', ['link_type' => $feedback->link->link_type])
                                        @endcomponent
                                    </strong><br>
                                    {!! $feedback->link->text !!}
                                </li>
                            @endif
                            <li class="list-group-item">
                                {!! $feedback->comment !!}
                            </li>
                        </ul>
                        <div class="panel-footer">
                            {!! $feedback->readableDate($feedback->created_at) !!}
                        </div>
                    </div> <!-- .panel -->
                <!-- </a> -->
            </div> <!-- .col -->
        @endforeach
    </div>

@endsection