@extends('layouts.app')

@section('title', 'Thanks for Contributing')

@section('content')
    <div class="page-header">
        <h1>Thanks for Contributing</h1>
    </div>

    <p>Thank you for contributing to the Park Link project! Please fill out the brief survey below, which will help us improve CommunityCrit.</p>

    <div style="display: none;">
    	{{ $user_id= strval(Auth::id() ) }}
    	{{ $url_data= "https://ucsdsocialsciences.co1.qualtrics.com/jfe/form/SV_39JQ1w8xjnvVPWR?user=" }}
    </div>

    <iframe height="2000px" width="100%" style="border:0" src="{{$url_data . $user_id}}"></iframe>

@endsection