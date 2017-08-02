@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{--<meta name="_token" content="{{ csrf_token() }}" />--}}
    <div class="page-header">
        <h1>
            <span>Park Link Challenge</span>
            <!-- <a role="button" class="btn btn-default pull-right" href="home.htm#this">View in context</a> -->
        </h1>
        <p>Text</p>
        <p>Text</p>
    </div>

    <h2>El Nudillo</h2>
    <div class="tab-content">

        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#submit" aria-controls="home" role="tab" data-toggle="tab">Submit an Idea</a></li>
                <li role="presentation"><a href="#improve" aria-controls="profile" role="tab" data-toggle="tab">Improve an Existing Idea</a></li>
                <li role="presentation"><a href="#rank" aria-controls="profile" role="tab" data-toggle="tab">Rank Proposals</a></li>
                <li role="presentation"><a href="{{ action( 'IdeaController@index' ) }}" aria-controls="profile">View All Ideas</a></li>
            </ul>
        </div>

        <div role="tabpanel" class="tab-pane active" id="submit">
            <p></p>
            {{--'action' => ['IdeaController@submitIdea'],--}}
            {!! Form::open([ 'action' => ['IdeaController@submitIdea'], 'id' => 'newsubmit']) !!}
            <div class="form-group">
                {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 1, 'required' => true]) !!}
            </div>
            <div class="form-group">
                <div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-left']) !!}
                    {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div role="tabpanel" class="tab-pane" id="improve">
            {!! Form::open(['action' => ['IdeaController@submitIdea']]) !!}
            <p>something activity here</p>
            <div class="form-group">
                {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 1, 'required' => true]) !!}
            </div>
            <div class="form-group">
                <div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-left']) !!}
                    {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

    {{--<script>--}}
        {{--$document.getElementById("newsubmit").on('submit', function (e) {--}}
            {{--e.preventDefault(e);--}}
            {{--$.ajaxSetup({--}}
                {{--header:$('meta[name="_token"]').attr('content')--}}
            {{--});--}}

            {{--$.ajax({--}}

                {{--type: "POST",--}}
                {{--url: '/home/submit',--}}
                {{--data: $(this).serialize(),--}}
                {{--dataType: 'json',--}}
                {{--success: function (data) {--}}
{{--//                    console.log(data);--}}
                {{--},--}}
                {{--error: function (data) {--}}

                {{--}--}}
            {{--})--}}
        {{--});--}}

        {{--function ajaxsubmit() {--}}
            {{--var x = document.getElementById('newsubmit');--}}
            {{--alert("The form was submitted");--}}
            {{--return false;--}}
{{--//            preventDefault();--}}
{{--//            $.ajaxSetup({--}}
{{--//                header:$('meta[name="_token"]').attr('content')--}}
{{--//            });--}}
{{--//--}}
{{--//            $.ajax({--}}
{{--//--}}
{{--//                type: "POST",--}}
{{--//                url: '/home/submit',--}}
{{--//                data: $(this).serialize(),--}}
{{--//                dataType: 'json',--}}
{{--//                success: function (data) {--}}
{{--////                    console.log(data);--}}
{{--//                },--}}
{{--//                error: function (data) {--}}
{{--//--}}
{{--//                }--}}
{{--//            });--}}
{{--//            return false;--}}
        {{--}--}}
    {{--</script>--}}

@endsection
