@extends('layouts.app')

@section('title', 'Activities')

@section('content')
    <div class="container">
        @foreach ($tasks as $task)
            <div class="col-sm-6 col-md-4">
                <a class="panel-link" href="{{ action('TaskController@show', $task->id) }}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">{{ $task->name }}</div>
                        </div> <!-- .panel-heading -->
                        <div class="panel-body">
                            <p>Activity description.</p>
                        </div> <!-- .panel-body -->
                    </div> <!-- .panel -->
                </a>
            </div> <!-- .col -->
        @endforeach
    </div>

@endsection
