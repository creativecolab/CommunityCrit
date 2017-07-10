@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h1>{{$quote->name}}</h1>
    </div>

    <p>{!! $quote->quote !!}</p>

    <blockquote>
        <p id="{{$quote->id}}"><strong>Entertainment and Innovation District</strong> – the four blocks at the South end of the 14th Street Promenade (between J Street and National Avenue) will become an Entertainment and Innovation District. Because it is near many waterfront industrial uses, design in this zone will celebrate the history of industry and innovation in San Diego. The 14th Street Promenade will include flexible spaces that can be programmed for varied uses and integrating historical artifacts and interpretive elements. A variety of seating opportunities are provided and plantings will accent the streetscape with color and shade. The Entertainment and Innovation District will showcase unique artifacts of East Village’s history including the display of Bob Sinclair artifacts in creative and functional ways.</p>
        {{--<img src="assets/hanging.jpg">--}}
        <footer><a href="">14th Street Promenade Master Plan</a>, filed under
            @foreach($quote->facets as $facet) <a class="label label-default" href="{{ action('TaskController@singleFacet', $facet->slug) }}">{{$facet->name}}</a>@endforeach</footer>
    </blockquote>

@endsection
