@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        @foreach ($projects as $project)
            <div class="col-sm-6 col-md-4">
                <a class="panel-link" href="{{ action('TaskController@show', $project->id) }}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">{{ $project->name }}<span class="viewComments pull-right"><span class="glyphicon glyphicon-comment" data-state="off" aria-hidden="true"></span><span class="commentCount">{{ $project->feedback->count() }}</span></span></div>
                        </div> <!-- .panel-heading -->
                        <div class="panel-body">
                            <p>Project description.</p>
                        </div> <!-- .panel-body -->
                    </div> <!-- .panel -->
                </a>
            </div> <!-- .col -->
        @endforeach
    </div>

@endsection
