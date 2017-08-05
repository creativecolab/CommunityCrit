@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <h1>Overview</h1>
    <div class="row">
        <div class="col-md-12">

            <div>
                <figure>
                    <img src="{{ asset('img/ElNudilloMap.png') }}" alt="project map" class="img-responsive" align="right" hspace="25" vspace="25">
                </figure>
            </div>

            <h3>El Nudillo</h3>
            <p>The 14th Street Promenade, which was approved by the city in 2016, will be a pedestrian-friendly “green street” extending from City College in the north to the intersection of 14th Street and National Avenue in the south. It will feature widened sidewalks, outdoor furniture, and art, in order to promote social gathering and a unique neighborhood feel. The overarching goal for the 14th Street Promenade is to help create a more sustainable, walkable downtown.</p>
            <p>We are now engaging the public and local experts to develop the intersection of 14th Street, National Avenue, and Commercial Street, which marks the end of the 14th Street Promenade. This intersection—known as El Nudillo, or “the knuckle”—is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>

            <h3>Here's Where You Come In</h3>
            <div class="col-md-3">
                <figure>
                    <img src="{{ asset('img/ElNudillo1.png') }}" alt="project map" class="img-responsive" align="right">
                    <figcaption>El Nudillo will mark the end of the 14th Street Promenade.</figcaption>
                </figure>
            </div>
            <p>Right now, El Nudillo is just an intersection. We need your help to figure out what El Nudillo should be!</p> 
            <p>CommunityCrit makes it easy to help shape plans for the future of your community. You will be able to suggest your own ideas and comment upon the ideas of other contributors for how El Nudillo can be transformed. Please answer as many or as few questions as you would like—you are always free to skip questions.</p>
            <p>All input will be shared with sponsors, designers, and community members to help shape the ultimate plan.</p>

            <div class="row">
                <figure>
                    <img src="{{ asset('img/timeline.png') }}" alt="project map" class="img-responsive">
                </figure>
            </div>
            
            <a type="button" class="btn btn-primary btn-lg" style="margin-top: 10px;" href="{{ route('do') }}">Take Me To An Activity</a>

        </div> <!-- .col -->
    </div> <!-- .row -->
    
           
        
@endsection
