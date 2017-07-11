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

    {{--collapsible--}}
    {{--<div id="accordion" role="tablist">--}}
        {{--@foreach ($tasks as $task)--}}
            {{--<p>{{ $task->quote }}--}}
                {{--<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$task->id}}" aria-expanded="true" aria-controls="collapseOne">(see original text)</a></p>--}}
            {{--<div id="{{$task->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">--}}
                {{--<blockquote>--}}
                    {{--<p>{!! $task->text !!}</p>--}}
                    {{--<footer><a href="{{ action('TaskController@singleSource', $task->source->slug) }}">{{ $task->source->name }}</a></footer>--}}
                {{--</blockquote>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

    @component('tasks.commentsPage', [ 'task' => $facet ])
    @endcomponent
@endsection
