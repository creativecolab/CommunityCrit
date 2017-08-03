@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <div style="display: none">
        {{ $count = count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 4) }}
    </div>

    <div class="activity" id="text-link">
        <div class="panel-group" role="tablist" style="margin-bottom: 30px;">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                    <h4 class="panel-title">
                        <a href="#collapseListGroup1" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup1"> About the Project </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse {{ $count < 1 ? 'in' : '' }} " role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="true">
                    <div class="panel-body">
                        <!-- <li class="list-group-item"> -->
                            <!-- <p><b>CommunityCrit allows the public to participate in the urban design process.</b> By offering a quick and easy way to voice opinions, CommunityCrit empowers anyone to help shape the future of their community. By collecting ideas from anyone, anywhere, at any time, CommunityCrit enables organizers to engage their community in the development of planning proposals.</p> -->
                        <!-- </li> -->
                        <!-- <li class="list-group-item"> -->
                            <p>Currently, community leaders are collaborating with the public and local experts to design the intersection of 14th Street and National Avenue, called <strong>“El Nudillo.”</strong> The future El Nudillo is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                            <strong>Please share your thoughts below!</strong>
                        <!-- </li> -->
                    </div>
                    <!-- <div class="panel-footer">Footer
                    </div> -->
                </div>
            </div>
        </div>

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
                    <a type="button" class="btn btn-default" href="{{ route('do')}}">Skip</a>
                    @if ($count >= 4)
                        <a type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">I want to stop</a>
                    @endif
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Proceed to Exit Survey</h4>
                                    </div>
                                    <div class="modal-body">
                                        Thanks for your contributions. Are you sure you want to stop contributing for now?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No, go back</button>
                                        {!! Form::submit('Yes, I\'m done', ['class' => 'btn btn-primary', 'name' => 'exit']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </li>
            </ul> <!-- list group -->
        </div> <!-- .panel -->

    </div> <!-- .container -->
@endsection
