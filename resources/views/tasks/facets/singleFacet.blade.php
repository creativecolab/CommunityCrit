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
        <p><strong>{{ $task->name }}</strong> - {!! $task->text !!}</p>
        <footer><a href="">14th Street Promenade Master Plan</a></footer>
    </blockquote>
    @endforeach

@endsection
