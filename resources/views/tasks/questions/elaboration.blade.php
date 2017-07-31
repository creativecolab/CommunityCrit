@extends('layouts.app')

@section('title', 'Build')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Activity</div>--}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        {!! $task->text !!}
                                    </div>

                                    <div class="panel-body">
                                        <strong>Idea:</strong> {!! $idea->text !!}

                                        {{--@if( isset($subtasks) )--}}
                                        {{--@foreach ($subtasks as $subtask)--}}
                                        {{--<strong>{{ $subtask->name }}@if(isset($recommendations) && $recommendations->contains($subtask->id))--}}
                                        {{--<span class="label label-primary">Recommended for You</span>@endif</strong>--}}
                                        {{--<p>{!! html_entity_decode($subtask->text) !!}</p>--}}
                                        {{--@endforeach--}}
                                        {{--@endif--}}
                                    </div>

                                    <div class="panel-body">
                                        <strong>Reference:</strong> {!! $link->text !!}
                                    </div>

                                    <div class="panel-footer">
                                        <form></form>
                                        {!! Form::open(['action' => ['TaskController@elaborate', $idea->id], 'style' => 'display:inline']) !!}
                                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                            {!! Form::label('comment', 'Share Your Thoughts:') !!}
                                            {!! Form::textarea('text', '', ['value' => 'text', 'class' => 'form-control', 'required' => 'true']) !!}

                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
                                        {{--{!! Form::submit('Skip', ['class' => 'btn btn-default pull-right']) !!}--}}
                                        {!! Form::close() !!}

                                        {{--{!! Form::open(['action' => ['TaskController@skipQuestion', $id], 'style' => 'display:inline']) !!}--}}
                                        {{--{!! Form::submit('Skip', ['class' => 'btn btn-default pull-right']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
