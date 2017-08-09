@extends('layouts.app')

@section('title', 'Overview')

@section('structured-content')
        
        <!-- <div class="jumbotron bg-no"> -->
            <div class="container pad bot">
                <h1>CommunityCrit</h1>
                <p>CommunityCrit is a research tool developed by the Design Lab at the University of California San Diego. The goal of CommunityCrit is to enable people to co-design the future of their communities by facilitating public contribution on urban design proposals. We have chosen the recent planning efforts around the 14th Street Promenade in the East Village neighborhood of downtown San Diego as our test case.</p>
            </div>
        <!-- </div> -->

        <div class="jumbotron bg-lt">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>The Design Challenge: <br class="rwd-break"/>El Nudillo</h2>
                        <p>The 14th Street Promenade, which was approved by the city in 2016, will be a pedestrian-friendly “green street” extending from City College in the north to the intersection of 14th Street and National Avenue in the south. It will feature widened sidewalks, outdoor furniture, and art, in order to promote social gathering and a unique neighborhood feel. The overarching goal for the 14th Street Promenade is to help create a more sustainable, walkable downtown.</p>
                        <p>We are now engaging the public and local experts to develop the intersection of 14th Street, National Avenue, and Commercial Street, which marks the end of the 14th Street Promenade. This intersection—known as <strong>El Nudillo</strong>, or “the knuckle”—is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <figure>
                            <img src="{{ asset('img/ElNudillo1.png') }}" alt="project map" class="img-responsive shdw" align="right">
                            <figcaption>El Nudillo will mark the end of the 14th Street Promenade.</figcaption>
                        </figure>
                    </div>
                    <!-- <div class="col-sm-2">
                        <img src="{{ asset('img/ElNudilloMap.png') }}" alt="project map" class="img-responsive" id="el-nudillo-map">
                    </div> -->
                </div>
            </div>
        </div>
        
        <div class="container pad bot">
            <div class="row">
                <div class="col-md-8 col-md-push-4">
                    <h2>Here's Where You Come In</h2>
                    <p>Right now, El Nudillo is just an intersection. We need your help to figure out what El Nudillo should be!</p> 
                    <p>CommunityCrit allows you to suggest your own ideas and comment upon the ideas of other contributors for how El Nudillo can be transformed. Please answer as many or as few questions as you would like—you are always free to skip questions.</p>
                    <p>All input will be shared with sponsors, designers, and community members to help shape the ultimate plan. <!-- Click <a href="{{ route('do') }}">here</a> to get started. --></p>
                    <a type="button" class="btn btn-primary hidden-xs" style="margin-top: 10px;" href="{{ route('do') }}">Get Started</a>
                    <a type="button" class="btn btn-primary btn-block hidden-sm hidden-md hidden-lg" style="margin-top: 10px;" href="{{ route('do') }}">Get Started</a>
                </div>
                <div class="col-md-4 col-md-pull-8">
                    <figure style="margin-top: 22px;">
                         <img src="{{ asset('img/timeline.svg') }}" alt="Project timeline" class="img-responsive">
                    </figure>
                </div>
                
            </div> <!-- .row -->
        </div>
        
@endsection
