@extends('layouts.app')

@section('title', 'Summary')

@section('content')
    <div id="main-menu">
        <h1>Your Responses</h1>

        @if($num_responses > 1)
        <p>Thank you for your {{$num_responses}} responses!</p>
        @elseif($num_responses == 1)
        <p>Thank you for your {{$num_responses}} response!</p>
        @else
        <p>You didn't answer any questions.</p>
        @endif

        <h2>Continue?</h2>
        <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
            Continue With Activities
        </a>

        <h2>All done?</h2>
        <a class="btn btn-primary" href="{{ route( 'exit') }}">
            Go to Exit Survey
        </a>
            {{--<h2>Submitted Ideas <span class="badge">{{count($myIdeas)}}</span></h2>--}}

            {{--<h2>References <span class="badge">{{count($myLinks)}}</span></h2>--}}
            {{--@if (!count($myLinks))--}}
                {{--<h4>You have not submitted any references yet.</h4>--}}
                {{--<!-- <a href="{{ route('do') }}">Get Started</a> -->--}}
            {{--@endif--}}

            {{--<div class="row">--}}
                {{--@foreach ($myLinks as $myLink)--}}
                    {{--<div class="col-md-12">--}}
                        {{--<!-- <div class="col-sm-6 col-lg-4"> -->--}}
                        {{--<!-- <a class="panel-link"> -->--}}
                        {{--<div class="panel panel-default">--}}
                            {{--@if ($myLink->idea)--}}
                                {{--<a class="panel-link" href="{{ action( 'IdeaController@show', $myLink->idea->id) }}">--}}
                                    {{--<div class="panel-heading">--}}
                                        {{--<div class="panel-title">Idea: {{ $myLink->idea->name }}</div>--}}
                                        {{--{{ $myLink->idea->text }}--}}
                                    {{--</div> <!-- .panel-heading -->--}}
                                {{--</a>--}}
                            {{--@endif--}}
                            {{--<ul class="list-group">--}}
                                {{--@if ($myLink->task)--}}
                                    {{--<li class="list-group-item">--}}
                                        {{--{!! $myLink->task->text !!}--}}
                                    {{--</li>--}}
                                {{--@else--}}
                                    {{--<li class="list-group-item"><strong>--}}
                                            {{--@component('utilities.link_type_name', ['link_type' => $myLink->link_type])--}}
                                            {{--@endcomponent--}}
                                        {{--</strong></li>--}}
                                {{--@endif--}}
                                {{--<li class="list-group-item">--}}
                                    {{--{!! $myLink->text !!}--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="panel-footer">--}}
                                {{--{{ $myLink->created_at }}--}}
                            {{--</div>--}}
                        {{--</div> <!-- .panel -->--}}
                        {{--<!-- </a> -->--}}
                    {{--</div> <!-- .col -->--}}
                {{--@endforeach--}}
            {{--</div>--}}

            {{--<h2>Improvements, Critiques, and Assessments <span class="badge">{{count($myFeedbacks)}}</span></h2>--}}
            {{--@if (!count($myFeedbacks))--}}
                {{--<h4>You have not submitted feedback yet.</h4>--}}
                {{--<a href="{{ route('do') }}">Get Started</a>--}}
            {{--@endif--}}

            {{--<div class="row">--}}
                {{--@foreach ($myFeedbacks as $myFeedback)--}}
                    {{--<div class="col-md-12">--}}
                        {{--<!-- <div class="col-sm-6 col-lg-4"> -->--}}
                        {{--<!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $myFeedback->id) }}"> -->--}}
                        {{--<div class="panel panel-default">--}}
                            {{--@if ($myFeedback->idea)--}}
                                {{--<a class="panel-link" href="{{ action( 'IdeaController@show', $myFeedback->idea->id) }}">--}}
                                    {{--<div class="panel-heading">--}}
                                        {{--<div class="panel-title">Idea: {{ $myFeedback->idea->name }}</div>--}}
                                        {{--{{ $myFeedback->idea->text }}--}}
                                    {{--</div> <!-- .panel-heading -->--}}
                                {{--</a>--}}
                            {{--@endif--}}
                            {{--<ul class="list-group">--}}
                                {{--@if ($myFeedback->task)--}}
                                    {{--<li class="list-group-item">--}}
                                        {{--@if($myFeedback->task->id != 12)--}}
                                            {{--{!! $myFeedback->task->text !!}--}}
                                        {{--@else--}}
                                            {{--{!! $questions->where('id',$myFeedback->ques_id)->first()->text !!}--}}
                                        {{--@endif--}}
                                    {{--</li>--}}
                                {{--@endif--}}
                                {{--@if ($myFeedback->link)--}}
                                    {{--<li class="list-group-item">--}}
                                        {{--<strong>Reference:--}}
                                            {{--@component('utilities.link_type_name', ['link_type' => $myFeedback->link->link_type])--}}
                                            {{--@endcomponent--}}
                                        {{--</strong><br>--}}
                                        {{--{!! $myFeedback->link->text !!}--}}
                                    {{--</li>--}}
                                {{--@endif--}}
                                {{--<li class="list-group-item">--}}
                                    {{--{!! $myFeedback->comment !!}--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="panel-footer">--}}
                                {{--{!! $myFeedback->readableDate($myFeedback->created_at) !!}--}}
                            {{--</div>--}}
                        {{--</div> <!-- .panel -->--}}
                        {{--<!-- </a> -->--}}
                    {{--</div> <!-- .col -->--}}
                {{--@endforeach--}}
            {{--</div>--}}
    </div>

@endsection