@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <div class="activity" id="text-link">
        @if ($idea)
            @component('activities.common.idea', ['idea' => $idea])
            @endcomponent
        @endif

        @if ($link)
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    Reference: 
                    @component('utilities.link_type_name', ['link_type' => $link->link_type])
                    @endcomponent
                    </h4>
                </div>
                <div class="panel-body">
                    {!! $link->text !!}
                </div>
            </div> -->
            <!-- <div class="well"> -->
                <blockquote>
                    <p>{!! $link->text !!}</p>
                </blockquote>
            <!-- </div> -->
        @endif

        <!-- <em>Task Type: {{ ($task->type) }}</em> -->

        <div class="panel panel-default no-marg-bot input">
            <!-- <div class="panel-heading">
                <div class="panel-title">
                    {!! $task->name !!}
                </div>
            </div> -->
            <!-- List group -->
            <ul class="list-group">
                
                <li class="list-group-item">
                    @if (intval(($task->type) / 10) == 8)
                        {!! Form::open(['action' => ['IdeaController@submitIdea'], 'style' => 'display:inline']) !!}
                        <!-- <em>Submission!</em> -->
                    @elseif (intval(($task->type) / 10) == 7)
                        {!! Form::open(['action' => ['LinkController@submitLink'], 'style' => 'display:inline']) !!}
                        <!-- <em>Link!</em> -->
                    @elseif ($task->type == 100)
                        {!! Form::open(['action' => ['TaskController@submitRatings'], 'style' => 'display:inline']) !!}
                    @else
                        {!! Form::open(['action' => ['TaskController@submitText', $idea->id], 'style' => 'display:inline']) !!}
                        <!-- <em>Everything else!</em> -->
                    @endif

                    {{ csrf_field() }}

                    @if ($idea)
                        {{ Form::hidden('idea', $idea->id) }}
                        @if ($link)
                        {{ Form::hidden('link', $link->id) }}
                    @endif
                    @endif
                    {{ Form::hidden('task', $task->id) }}
                    
                    @if ($task->type != 100)
                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <label class="instruction" for="submissionText">{!! $task->text !!}</label>
                            <textarea class="form-control" rows="3" id="submissionText" name="text"></textarea>
                            @if ($errors->has('text'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('text') }}</strong>
                                </span>
                            @endif
                        </div>
                    @else
                        <label class="instruction">{!! $task->text !!}</label>
                        @component('activities.common.rating', ['qualities' => $qualities])
                        @endcomponent
                    @endif

                    @if (($task->type) / 10 == 8)
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="instruction" for="submissionText">Give your idea a name. <span class="text-muted">(optional)</span></label>
                                    <input type="text" class="form-control" name="name"></input>
                                </div>
                            </div> <!-- .col -->
                        </div>
                    @endif

                    {!! Form::submit('Submit', ['class' => 'btn btn-success', 'name' => 'exit']) !!}
                    {!! Form::submit('Go to exit survey', ['class' => 'btn btn-default', 'name' => 'exit']) !!}
                    <a type="button" class="btn btn-default" href="{{ route('do') }}">Skip</a>
                    {!! Form::close() !!}
                </li>
            </ul> <!-- list group -->
        </div> <!-- .panel -->

    </div> <!-- .container -->
@endsection
