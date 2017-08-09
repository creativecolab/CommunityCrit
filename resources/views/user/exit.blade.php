@extends('layouts.app')

@section('title', 'Thanks for Contributing')

@section('content')
    <div class="page-header">
        <h1>Thanks for Contributing</h1>
    </div>

    <p>Thank you for contributing to the Park Link project! Your input will be shared with the sponsors, designers, and community members to help shape the plan.</p>

    <p>Please help us by completing the short survey below. We will use your responses to improve CommunityCrit so that it can better serve communities in the planning process.</p>

    <p>You may also look at <a href="{{ route('my-contributions') }}">your contributions</a> or see the <a href="{{ route('ideas') }}">contributions of your fellow community members.</a></p>

    <div style="display: none;">
    	{{ $user_id= strval(Auth::id() ) }}
    	{{ $url_data= "https://ucsdsocialsciences.co1.qualtrics.com/jfe/form/SV_39JQ1w8xjnvVPWR?user=" }}
    </div>

    <iframe height="2000px" width="100%" style="border:0" src="{{$url_data . $user_id}}"></iframe>

@endsection