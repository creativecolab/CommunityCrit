@extends('layouts.app')

@section('title', 'About')

@section('content')
    <h1>About</h1>
        
        <div class="col-sm-2">
    		<figure>
                <img src="{{ asset('img/ElNudillo1.png') }}" alt="project map" class="img-responsive" align="right">
            </figure>
        </div>

    	<h3>The Park Link Steering Committee</h3>
    	<p>The Park Link Steering Committee helped develop the East Village South Draft Focus Plan and the 14th Street Master Plan. Their members include Roger Lewis, President of C3, Beth Callender, the incoming Chair of the Urban Land Institute's San Diego/Tijuana District Council, residents of East Village, and architects and city planners from around San Diego.</p><p>The team is now working with the community and local experts to design potential additions to the 14th Street Promenade, including El Nudillo, at the intersection of 14th Street and National Avenue.</p>

    	<h3>CommunityCrit</h3>
        <p>We are a team of researchers in the Design Lab at the University of California San Diego, led by Professor Steven Dow and Dr. Narges Mahyar. Our goal is to develop technologies that enable people to co-design the future of their communities.</p>We have created CommunityCrit (short for Community Critique) to facilitate community participation, supplement traditional face-to-face workshops, and collect broader feedback on urban design projects. We have chosen the recent planning efforts around the 14th Street Promenade in the East Village neighborhood of downtown San Diego as our test case.</p>

        <h3>Partners</h3>
        <p><a href="mailto:beth@callenderworks.com">Beth Callender</a></p>
        <p>Citizens Coordinate for Century 3</p>
        <p>East Village People</p>

@endsection
