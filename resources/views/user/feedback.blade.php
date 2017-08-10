@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
    <div class="row smaller-txt" id="feedback">
        <div class="col-md-6">
            <h1>My Contributions</h1>
            <h2>Submitted Ideas <span class="badge">{{count($myIdeas)}}</span></h2>
            @if (!count($myIdeas))
                <h4>You have not submitted any ideas yet.</h4>
                <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
                    Submit a New Idea
                </a>
            @endif

            <div class="row">
                @foreach ($myIdeas as $myIdea)
                    <div class="col-md-12">
                    <!-- <div class="col-sm-6 col-lg-4"> -->
                        <a class="panel-link" href="{{ action( 'IdeaController@show', $myIdea->id) }}">
                            <div class="panel panel-default">
                                @if ($myIdea->name)
                                    <div class="panel-heading">
                                        <div class="panel-title"><h4>{{ $myIdea->name }}</h4></div>
                                    </div> <!-- .panel-heading -->
                                @endif
                                <div class="panel-body">
                                    {{ $myIdea->text }}
                                </div> <!-- .panel-body -->
                                <div class="panel-footer">
                                    {!! $myIdea->readableDate($myIdea->created_at) !!}
                                </div>
                            </div> <!-- .panel -->
                        </a>
                    </div> <!-- .col -->
                @endforeach
            </div>

            <h2>References <span class="badge">{{count($myLinks)}}</span></h2>
            @if (!count($myLinks))
                <h4>You have not submitted any references yet.</h4>
                <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
                    Do An Activity
                </a>
            @endif

            <div class="row">
                @foreach ($myLinks as $myLink)
                    <div class="col-md-12">
                    <!-- <div class="col-sm-6 col-lg-4"> -->
                        <!-- <a class="panel-link"> -->
                            <div class="panel panel-default">
                                @if ($myLink->idea)
                                    <a class="panel-link" href="{{ action( 'IdeaController@show', $myLink->idea->id) }}">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Idea: {{ $myLink->idea->name }}</h4></div>
                                            {{ $myLink->idea->text }}
                                        </div> <!-- .panel-heading -->
                                    </a>
                                @endif
                                <ul class="list-group">
                                    @if ($myLink->task)
                                        <li class="list-group-item">
                                            {!! $myLink->task->text !!}
                                        </li>
                                    @else
                                        <li class="list-group-item"><strong>
                                            @component('utilities.link_type_name', ['link_type' => $myLink->link_type])
                                            @endcomponent
                                        </strong></li>
                                    @endif
                                    <li class="list-group-item">
                                        {!! $myLink->text !!}
                                    </li>
                                </ul>
                                <div class="panel-footer">
                                    {!! $myLink->readableDate($myLink->created_at) !!}
                                </div>
                            </div> <!-- .panel -->
                        <!-- </a> -->
                    </div> <!-- .col -->
                @endforeach
            </div>

            <h2>Improvements, Critiques, and Assessments <span class="badge">{{count($myFeedbacks)}}</span></h2>
            @if (!count($myFeedbacks))
                <h4>You have not submitted feedback yet.</h4>
                <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
                    Do An Activity
                </a>
            @endif

            <div class="row">
                @foreach ($myFeedbacks as $myFeedback)
                    <div class="col-md-12">
                    <!-- <div class="col-sm-6 col-lg-4"> -->
                        <!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $myFeedback->id) }}"> -->
                            <div class="panel panel-default">
                                @if ($myFeedback->idea)
                                    <a class="panel-link" href="{{ action( 'IdeaController@show', $myFeedback->idea->id) }}">
                                        <div class="panel-heading">
                                            <div class="panel-title"><h4>Idea: {{ $myFeedback->idea->name }}</h4></div>
                                            {{ $myFeedback->idea->text }}
                                        </div> <!-- .panel-heading -->
                                    </a>
                                @endif
                                <ul class="list-group">
                                    @if ($myFeedback->task)
                                        <li class="list-group-item">
                                            @if($myFeedback->task->id != 12)
                                            {!! $myFeedback->task->text !!}
                                            @else
                                            {!! $questions->where('id',$myFeedback->ques_id)->first()->text !!}
                                            @endif
                                        </li>
                                    @endif
                                    @if ($myFeedback->link)
                                        <li class="list-group-item">
                                            <strong>Reference: 
                                                @component('utilities.link_type_name', ['link_type' => $myFeedback->link->link_type])
                                                @endcomponent
                                            </strong><br>
                                            {!! $myFeedback->link->text !!}
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        {!! $myFeedback->comment !!}
                                    </li>
                                </ul>
                                <div class="panel-footer">
                                    {!! $myFeedback->readableDate($myFeedback->created_at) !!}
                                </div>
                            </div> <!-- .panel -->
                        <!-- </a> -->
                    </div> <!-- .col -->
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <h1>All Ideas <span class="badge">{{count($ideas)}}</span></h1>
            @if (!count($ideas))
                <h4>No ideas have been submitted yet.</h4>
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
                                        <div class="panel-title"><h4>{{ $idea->name }}</h4></div>
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
        </div>
    </div> <!-- .row -->

@endsection