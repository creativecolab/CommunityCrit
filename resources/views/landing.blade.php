@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <!-- <h1>Overview</h1> -->
    <h3>CommunityCrit</h3>
    <div class="row">
        <div class="col-sm-10">
            <p>CommunityCrit is a new research tool, developed by researchers at the University of California San Diego's Design Lab. The goal of CommunityCrit is to enable people to co-design the future of their communities by facilitating public contribution on urban design proposals. We have chosen the recent planning efforts around the 14th Street Promenade in the East Village neighborhood of downtown San Diego as our test case.</p>
        </div>
    </div>
    <h3>El Nudillo</h3>
    <div class="row">
        <div class="col-sm-10">
            <p>The 14th Street Promenade, which was approved by the city in 2016, will be a pedestrian-friendly “green street” extending from City College in the north to the intersection of 14th Street and National Avenue in the south. It will feature widened sidewalks, outdoor furniture, and art, in order to promote social gathering and a unique neighborhood feel. The overarching goal for the 14th Street Promenade is to help create a more sustainable, walkable downtown.</p>
            <p>We are now engaging the public and local experts to develop the intersection of 14th Street, National Avenue, and Commercial Street, which marks the end of the 14th Street Promenade. This intersection—known as <strong>El Nudillo</strong>, or “the knuckle”—is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
        </div>
        <div class="col-sm-2">
            <img src="{{ asset('img/ElNudilloMap.png') }}" alt="project map" class="img-responsive" id="el-nudillo-map">
        </div>
    </div>
    <h3>Here's Where You Come In</h3>
    <div class="row">
        <div class="col-sm-4">
            <figure>
                <img src="{{ asset('img/ElNudillo1.png') }}" alt="project map" class="img-responsive" align="right">
                <figcaption>El Nudillo will mark the end of the 14th Street Promenade.</figcaption>
            </figure>
        </div>
        <div class="col-sm-8">
            <p>Right now, El Nudillo is just an intersection. We need your help to figure out what El Nudillo should be!</p> 
            <p>CommunityCrit makes it easy to help shape plans for the future of your community. You will be able to suggest your own ideas and comment upon the ideas of other contributors for how El Nudillo can be transformed. Please answer as many or as few questions as you would like—you are always free to skip questions.</p>
            <p>All input will be shared with sponsors, designers, and community members to help shape the ultimate plan. Click <a href="{{ route('do') }}">here</a> to get started.</p>

            <img src="{{ asset('img/timeline.png') }}" alt="project map" class="img-responsive" style="padding-top: 15px; padding-bottom: 15px;">
        </div>
    </div> <!-- .row -->
    <a type="button" class="btn btn-primary btn-lg" style="margin-top: 10px;" href="{{ route('do') }}">Take Me To An Activity</a>
@endsection
