@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <div class="activity" id="text-link">
        <!-- <div class="row"> -->
            <!-- <div class="col-md-8 col-md-offset-2"> -->

                <!-- <div class="well"> -->
                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-responsive" src="/img/placeholder.jpg"></img>
                        </div>
                        <div class="col-md-9">
                            <h2 class="no-marg-top">
                            Idea: {!! $idea->name !!}
                            <button class="btn btn-default pull-right">Switch idea</button>
                            </h2>
                            <p>{!! $idea->text !!}</p>
                        </div>
                    </div> <!-- .row -->
                
                    <div class="panel panel-default no-marg-bot input">
                        <div class="panel-heading">
                            <div class="panel-title">
                                {!! $task->name !!}
                            </div>
                        </div>
                        <!-- List group -->
                        <ul class="list-group">
                            @if ($link)
                                <li class="list-group-item">
                                    <h4 class="no-marg-top">Reference: 
                                        @component('utilities.link_type_name', ['link_type' => $link->link_type])
                                        @endcomponent
                                    </h4>
                                    <p class="no-marg-bot">
                                        {!! $link->text !!}
                                    </p>
                                </li>
                            @endif
                            <li class="list-group-item">
                                {!! Form::open(['action' => ['TaskController@elaborate', $idea->id], 'style' => 'display:inline']) !!}
                                <!-- Form::open(array('class' => 'form-horizontal', 'method' => 'put', 'action' => array('TankController@update', $aid, $id))) -->

                                {{ Form::hidden('idea', $idea->id) }}
                                {{ Form::hidden('task', $task->id) }}
                                @if ($link)
                                    {{ Form::hidden('link', $link->id) }}
                                @endif

                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <!-- {!! Form::label('comment', 'Share Your Thoughts:') !!} -->
                                    <div class="form-group">
                                        <label class="instruction" for="submissionText">{!! $task->text !!}</label>
                                        <textarea class="form-control" rows="3" id="submissionText" name="text"></textarea>
                                    </div>
                                    <!-- {!! Form::textarea('text', '', ['value' => 'text', 'class' => 'form-control', 'required' => 'true']) !!} -->

                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                <button class="btn btn-danger pull-right done">Stop</button>
                                <button class="btn btn-default pull-right">Skip</button>
                                {!! Form::close() !!}
                            </li>
                        </ul> <!-- list group -->
                    </div> <!-- .panel -->
                <!-- </div> .well -->

            <!-- </div> .col -->
        <!-- </div> .row -->
    </div> <!-- .container -->
@endsection
