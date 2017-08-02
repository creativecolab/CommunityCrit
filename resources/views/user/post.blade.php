@extends('layouts.app')

@section('title', 'Thanks for Contributing')

@section('content')
    <div class="page-header">
        <h1>Thanks for Contributing</h1>
    </div>

    <p>Thank you for contributing to the Park Link project! Your input will be shared with the sponsors, designers, and community members to help shape the plan.</p>

    <p>Please help us by completing the short survey below. You may also look at <a href="{{ route('my-contributions') }}">your contributions</a> or see the <a href="{{ route('ideas') }}">contributions of your fellow community members.</a></p>

    <p><iframe height="2000px" width="100%" style="border:0" src="https://ucsdsocialsciences.co1.qualtrics.com/jfe/form/SV_39JQ1w8xjnvVPWR"></iframe></p>

@endsection