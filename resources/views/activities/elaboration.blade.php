@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <h4 class="text-center" id="waiting">
        Finding an activity for you...
    </h4>

    <div style="display: none">
        {{ $count = count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 4) }}
    </div>

    <div class="activity" id="text-link">
        <!-- <div class="panel-group" role="tablist" style="margin-bottom: 30px;">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                    <h4 class="panel-title">
                        <a href="#collapseListGroup1" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup1"> About the Project </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse {{ $count < 1 ? 'in' : '' }} " role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="true">
                    <div class="panel-body">
                            <p>Currently, community leaders are collaborating with the public and local experts to design the intersection of 14th Street and National Avenue, called <strong>“El Nudillo.”</strong> The future El Nudillo is envisioned as a pedestrian destination, a place of social gathering, and a celebration of East Village and its surrounding neighborhoods.</p>
                            <strong>Please share your thoughts below!</strong>
                    </div>
                </div>
            </div>
        </div> -->

        @if ($idea->id)
            @component('activities.common.idea', ['idea' => $idea, 'link' => $link])
            @endcomponent
        @endif

        <!-- <em>Task Type: {{ ($task->type) }}</em> -->

        <div class="panel panel-primary no-marg-bot input" id="task-panel" style="opacity: 0;">
            <div class="panel-heading">
                <div class="panel-title">
                    {!! $task->name !!} -- You are on task {{\Session::get('t_ptr')}} of 5
                </div>
            </div>
            <!-- List group -->
            <ul class="list-group">
                
                <li class="list-group-item">
                    @if (intval(($task->type) / 10) == 8)
                        {!! Form::open(['action' => ['TaskController@submitIdea'], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                        <!-- <em>Submission!</em> -->
                    @elseif (intval(($task->type) / 10) == 7)
                        {!! Form::open(['action' => ['TaskController@submitLink'], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                        <!-- <em>Link!</em> -->
                    @elseif ($task->type == 100)
                        {!! Form::open(['action' => ['TaskController@submitRatings'], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                    @else
                        {!! Form::open(['action' => ['TaskController@submitText', $idea->id], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                        <!-- <em>Everything else!</em> -->
                    @endif

                    {{ csrf_field() }}

                    @if ($idea->id)
                        {{ Form::hidden('idea', $idea->id) }}
                        @if ($link->id)
                            {{ Form::hidden('link', $link->id) }}
                        @endif
                        @if ($ques->id)
                            {{ Form::hidden('ques', $ques->id) }}
                        @endif
                    @endif
                    {{ Form::hidden('task', $task->id) }}
                    
                    @if ($task->type != 100)
                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <label class="instruction" for="submissionText">
                                @if ($task->type == 61)
                                    {!! $ques->text !!}
                                @else
                                    {!! $task->text !!}
                                @endif

                            </label>
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

                    <!-- submission task -->
                    @if (intval($task->type) / 10 == 8)
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="instruction" for="submissionText">Give your idea a name. <span class="text-muted">(optional)</span></label>
                                    <input type="text" class="form-control" name="name"></input>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> <!-- .col -->
                        </div>
                    @endif

                    <!-- linking task -->
                    @if ((intval($task->type / 10) == 7) && ($task->text2))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="instruction" for="submissionText">{{ $task->text2 }} <span class="text-muted">(optional)</span></label>
                                    <input type="text" class="form-control" name="text2"></input>
                                </div>
                            </div> <!-- .col -->
                        </div>
                    @endif

                    {!! Form::submit('Submit', ['class' => 'btn btn-success', 'name' => 'exit']) !!}
                    <input id="btntest" type="button" class="btn btn-link" value="Skip" onclick="return btntest_onclick();" />
                    <!-- {!! Form::submit('Skip', ['class' => 'btn btn-default', 'name' => 'exit', 'onclick' => 'return btntest_onclick();']) !!} -->
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
    <script>
        function btntest_onclick()
        {
            $("#task-form").attr("action", "{{ action('TaskController@trackSkip', $idea->id) }}").submit();

            console.log("test");

            if ($('.activity #idea').length > 0) {
                $('#task-panel').fadeTo(500, 0);
                $('.activity #idea').delay(500).fadeTo(500, 0, function() {
                    $('#waiting').show();
                    // window.location.assign("{{ route('do') }}");
                });
            }
            else {
                $('#task-panel').fadeTo(500, 0, function() {
                    $('#waiting').show();
                    // window.location.assign("{{ route('do') }}");
                });
            }
        }
    </script>
@endsection
