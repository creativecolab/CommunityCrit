@extends('layouts.app')

@section('title', 'Ideas')

@section('content')
    @foreach ($ideas as $idea)
        <div class="col-sm-6 col-md-4">
            <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">{{$idea->name}}</div>
                    </div> <!-- .panel-heading -->
                    <div class="panel-body">
                        {!! $idea->text !!}
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </a>
        </div> <!-- .col -->
    @endforeach

@endsection
