@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="page-header">
        <h1>
            <span>{{ $source->name }}</span>
            <!-- <a role="button" class="btn btn-default pull-right" href="home.htm#this">View in context</a> -->
        </h1>
    </div>

    @foreach ($quotes as $quote)
        <p id="1"><strong>{{ $quote->name }}</strong> {!! $quote->text !!} <a class="viewComments" href="{{ action('TaskController@quote', $quote->id) }}"><span class="glyphicon glyphicon-comment" data-state="off" aria-hidden="true"></span><span class="commentCount">{{ $quote->feedback->count() }}</span></a>
            @foreach ($quote->facets as $facet) <a class="label label-default" href="{{ action('TaskController@singleFacet', $facet->slug) }}">{{$facet->name}}</a> @endforeach
    @endforeach

@endsection
