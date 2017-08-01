@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="page-header">
        <h1>About</h1>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h2>Park Link Project</h2>
            <p>The Master Plan for the 14th Street Promenade, which extends from City College to the intersection at National Ave, was approved by the Downtown Community Planning Council in June 2016. With the goal of creating a more sustainable, walkable downtown, the Promenade will feature widened sidewalks, outdoor seating, and art in order to promote social gathering and community expression.</p>
            <p>Community leaders are currently engaging the public and local experts to design additions to this project. They are using this platform to get your help in forming ideas around developing the intersection of 14th Street and National Avenue, known as El Nudillo. Select an option below to get started!</p>

            <h2>About the CommunityCrit Team</h2>
            <p>We are a team of researchers in the Design Lab at the University of California San Diego. Our goal is to develop technologies that enable people to share their ideas about designing the future of their communities. We hope that our online tool, CommunityCrit, will facilitate community participation and supplement traditional face-to-face workshops to get broader feedback on urban design projects.
            We have chosen the recent planning efforts around the extension of the 14th Street Promenade in the East Village neighborhood of downtown San Diego as our test case.</p>
            <p>Earlier this summer, we attended a public planning workshop in the East Village neighborhood of San Diego about the Park Link project. While the workshop was successful, we found that participation in face-to-face meetings is often complicated by scheduling conflicts, challenges in speaking up and by the result of time constraints of the session format. </p>
            
            <h2>Here’s Where You Come In</h2>
            <p>We have designed an online tool called, CommunityCrit (short for Community Critique). It offers a quick and convenient way for anyone, like you, to voice your concerns, suggest alternatives, and share your values during the design and planning process – when it’s convenient for you.</p>  
            <p>How does it work? CommunityCrit provides feedback activities based on your interests and available time. This input will be shared with sponsors, designers, and community members to help shape the ultimate plan.</p>
        </div> <!-- .col -->
        <div class="col-md-3">
            <figure>
              <img src="{{ asset('img/vector-map.png') }}" alt="project map" class="img-responsive">
              <figcaption>A map of the location of El Nudillo.</figcaption>
            </figure>
            
        </div> <!-- .col -->
    </div> <!-- .row -->
@endsection
