@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <div class="activity" id="text-link">
        @component('activities.common.idea', ['idea' => $idea])
        @endcomponent

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
                    {!! Form::open(['action' => ['TaskController@submitText', $idea->id], 'style' => 'display:inline']) !!}
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
                    
                    {!! Form::close() !!}
                </li>
            </ul> <!-- list group -->
        </div> <!-- .panel -->

    </div> <!-- .container -->
@endsection
