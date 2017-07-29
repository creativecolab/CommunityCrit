@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
    @foreach ($feedbacks as $feedback)
        <div class="col-sm-6 col-lg-4">
            <!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $feedback->id) }}"> -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Idea: Build a tower</div>
                        Build a tower in the center of the intersection.
                    </div> <!-- .panel-heading -->
                    <div class="panel-body">
                        <strong>{!! $feedback->task->name !!}</strong></br>
                        {!! $feedback->task->text !!}
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

@endsection