@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="page-header">
        <h1>
            <span>{{ $facet->name }}</span>
            <!-- <a role="button" class="btn btn-default pull-right" href="home.htm#this">View in context</a> -->
        </h1>
    </div>

    @foreach ($tasks as $task)
    <p>{{ $task->quote }}</p>
    <blockquote>
        <p>{!! $task->text !!}</p>
        <footer><a href="{{ action('TaskController@singleSource', $task->source->slug) }}">{{ $task->source->name }}</a></footer>
    </blockquote>
    @endforeach

    @component('tasks.commentsPage', [ 'task' => $facet ])
    @endcomponent
@endsection
