@extends('layouts.app')

@section('title', 'Build')

@section('content')
    <div class="container activity" id="text-link">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="well">
                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-responsive" src="/images/placeholder.jpg"></img>
                        </div>
                        <div class="col-md-9">
                            <h2 class="no-marg-top">
                            Idea: {!! $idea->text !!}
                            <button class="btn btn-default pull-right">Switch idea</button>
                            </h2>
                            <p>About the idea...Meantime, Fedallah was calmly eyeing the right whale's head, and ever and anon glancing from the deep wrinkles there to the lines in his own hand. And Ahab chanced so to stand, that the Parsee occupied his shadow; while, if the Parsee's shadow was there at all it seemed only to blend with, and lengthen Ahab's. As the crew toiled on, Laplandish speculations were bandied among them, concerning all these passing things.</p>
                        </div>
                    </div> <!-- .row -->
                
                    <div class="panel panel-default no-marg-bot input">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Improve the Idea
                            </div>
                        </div>
                        <div class="panel-body">
                            <h4 class="no-marg-top">Reference: Project Goal</h4>
                            <p class="no-marg-bot">
                                {!! $link->text !!}
                            </p>
                        </div>
                        <!-- List group -->
                        <ul class="list-group">
                            <li class="list-group-item">
                                {!! Form::open(['action' => ['TaskController@elaborate', $idea->id], 'style' => 'display:inline']) !!}
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <!-- {!! Form::label('comment', 'Share Your Thoughts:') !!} -->
                                    <div class="form-group">
                                        <label class="instruction" for="submissionText">{!! $task->text !!}</label>
                                        <textarea class="form-control" rows="3" id="submissionText" name="text" value="text"></textarea>
                                    </div>
                                    <!-- {!! Form::textarea('text', '', ['value' => 'text', 'class' => 'form-control', 'required' => 'true']) !!} -->

                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                <button class="btn btn-success pull-right done">I'm Done</button>
                                <button class="btn btn-default pull-right">Skip</button>
                                {!! Form::close() !!}
                            </li>
                        </ul> <!-- list group -->
                    </div> <!-- .panel -->
                </div> <!-- .well -->

            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
