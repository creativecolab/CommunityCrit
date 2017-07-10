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
        <p>{{ $quote->quote }}</p>
        <blockquote>
            <p><strong>{{ $quote->name }}</strong> - {!! $quote->text !!}</p>
            <footer><a href="">14th Street Promenade Master Plan</a></footer>
        </blockquote>
    @endforeach

@endsection
