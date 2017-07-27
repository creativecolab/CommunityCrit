@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')

    <div class="page-header">
        <h1>
            <span>{{ $idea->text }}</span>
            <!-- <a role="button" class="btn btn-default pull-right" href="home.htm#this">View in context</a> -->
        </h1>
    </div>

    @foreach ($links as $link)
        <p>{{$link->text}}</p>
    @endforeach

    {{--@component('tasks.commentsPage', [ 'task' => $source ])--}}
    {{--@endcomponent--}}
@endsection
