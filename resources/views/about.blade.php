@extends('layouts.app')

@section('title', 'About')

@section('content')
    <h1>About</h1></br>
        
    <div class="row">
        <div class="col-md-9">
        	<h3>The Park Link Steering Committee</h3>
        	<p>The Park Link Steering Committee helped develop the East Village South Draft Focus Plan and are exploring ways to enhance the 14th Street Green Street program that is already in place and approved by Civic San Diego. Their members include <a href="http://c3sandiego.org/page-1265206" target="_blank">Roger Lewis</a>, President of C-3, <a href="mailto:beth@callenderworks.com" target="_blank">Beth Callender</a>, of CallenderWorks, residents of East Village, and architects and city planners from around San Diego.</p><p>The team is now working with the community and local experts to design potential additions to the 14th Street Promenade, including El Nudillo, at the intersection of 14th Street and National Avenue.</p>

        	<h3>CommunityCrit</h3>
            <p>We are a team of researchers in the Design Lab at the University of California San Diego, led by Professor Steven Dow and Dr. Narges Mahyar. Our goal is to develop technologies that enable people to co-design the future of their communities.</p>We have created CommunityCrit (short for Community Critique) to facilitate community participation, supplement traditional face-to-face workshops, and collect broader feedback on urban design projects. We have chosen the recent planning efforts around the 14th Street Promenade in the East Village neighborhood of downtown San Diego as our test case.</p>

            <h3>Partners</h3>
            <p><a href="http://c3sandiego.org/" target="_blank">Citizens Coordinate for Century 3</a></p>
            <p><a href="https://www.facebook.com/eastvillagesouth/" target="_blank">East Village South Community Vision</a></p>

            <h3>Contact Us</h3>
            Send us an <a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#99;&#111;&#109;&#109;&#117;&#110;&#105;&#116;&#121;&#99;&#114;&#105;&#116;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;'>email</a> if you have any questions or concerns.
        </div> <!-- .col -->

        <div class="col-md-3">
            <figure>
                <img src="{{ asset('img/vector-map.png') }}" alt="project map" class="img-responsive">
                <figcaption>A map of the Park Link project area showing the El Nudillo challenge. The blocks approved for 14th Street Master Plan are marked in green.</figcaption>
            </figure>
        </div> <!-- .col -->
    </div> <!-- .row -->
        
@endsection
