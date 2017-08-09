@extends('layouts.app')

@section('title', 'Exit Survey')

@section('content')
    <h1>Exit Survey</h1>

    <p>Thank you for contributing to the Park Link project! We will use your responses to the following questions to improve CommunityCrit.</p>

    <div style="display: none;">
    	{{ $user_id= strval(Auth::id() ) }}
    	{{ $url_data= "https://ucsdsocialsciences.co1.qualtrics.com/jfe/form/SV_39JQ1w8xjnvVPWR?user=" }}
    </div>

    <iframe height="2000px" width="100%" style="border:0" src="{{$url_data . $user_id}}"></iframe>

@endsection