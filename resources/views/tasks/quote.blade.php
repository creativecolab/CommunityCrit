@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h1>{{$quote->name}}</h1>
    </div>

    <p>{!! $quote->quote !!}</p>

    <blockquote>
        <p id="{{$quote->id}}"> {!! $quote->text !!}</p>
        {{--<img src="assets/hanging.jpg">--}}
        <footer><a href="{{ action('TaskController@singleSource', $quote->source->slug) }}">{{$quote->source->name}}</a>, filed under
            @foreach($quote->facets as $facet) <a class="label label-default" href="{{ action('TaskController@singleFacet', $facet->slug) }}">{{$facet->name}}</a>@endforeach</footer>
    </blockquote>

    @component('tasks.commentsPage', [ 'task' => $quote ])
    @endcomponent
@endsection
