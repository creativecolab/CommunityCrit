@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <!-- standby instruction -->
    <!-- <h4 class="text-center" id="waiting">
        Finding an activity for you...
    </h4> -->

    <!-- set count var -->
    <div style="display: none">
        {{ $count = count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 4) }}
    </div>

    <div class="activity" id="text-link">
        {{--@if ($count >= 4)--}}
            <a type="button" class="btn btn-default" id="back" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Do An Activity</a>
        {{--@endif--}}
        <!-- List group -->
        <ul class="list-group">
            @if ($idea->id)
                <li class="list-group-item" id="idea">
                    @component('activities.common.idea', ['idea' => $idea, 'link' => $link])
                    @endcomponent
                </li>
            @endif

            <li class="list-group-item dark" id="question" style="opacity: 0;">
                <h4>Question {{\Session::get('t_ptr')}}/5</h4>
                <h3>
                    @if ($task->type == 61)
                        {!! $ques->text !!}
                    @else
                        {!! $task->text !!}
                    @endif
                </h3>
            </li>
            
            <li class="list-group-item" id="detail" style="opacity: 0;">
                
                <div id="link">
                    @if ($link->id)
                        @component('activities.common.link', ['link' => $link])
                        @endcomponent
                    @endif
                </div>

                <div id="response">

                    @if (intval(($task->type) / 10) == 4)
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
                            <!-- <label class="instruction" for="submissionText">
                                
                                {!! $task->name !!}

                            </label> -->
                            <textarea class="form-control" rows="3" id="submissionText" name="text" placeholder="Please enter your response here."></textarea>
                            @if ($errors->has('text'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('text') }}</strong>
                                </span>
                            @endif
                        </div>
                    @else
                        <label class="instruction">{!! $task->text !!}</label>
                        @component('activities.common.rating', ['qualities' => $qualities, 'mapped_qualities' => $mapped_qualities])
                        @endcomponent
                    @endif

                    <!-- submission task -->
                    @if (intval($task->type) / 10 == 8)
                        <div class="row">
                            <div class="col-sm-8 col-md-6">
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

                    <!-- <div>
                        {{--@if ($count >= 4)--}}
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Back to Main Menu</a>
                        {{--@endif--}} -->
                        <div class="pull-right" id="actions">
                            @if (intval(($task->type) / 10) != 4)
                            <a id="skip" value="Skip >" onclick="return skip_onclick();">Skip <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                    <!-- {!! Form::submit('Skip', ['class' => 'btn btn-default', 'name' => 'exit', 'onclick' => 'return btntest_onclick();']) !!} -->
                            @endif
                            {!! Form::submit('Submit', ['class' => 'btn btn-success', 'name' => 'exit']) !!}
                        </div>
                        <div class="clearfix"></div>
                    <!-- </div> -->
                    
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Return to Do An Activity</h4>
                                    </div>
                                    <div class="modal-body">
                                        Thanks for your help. Are you sure you want to stop working on this idea?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No, continue</button>
                                        {!! Form::submit("Yes, I'm done", ['class' => 'btn btn-primary', 'name' => 'exit']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div> <!-- #response -->
            </li>
        </ul> <!-- list group -->
        <!-- <div>
            {{--@if ($count >= 4)--}}
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Back to Main Menu</a>
            {{--@endif--}}
        </div> -->
    </div> <!-- .container -->
    <script>
        function skip_onclick()
        {
            $("#task-form").attr("action", "{{ action('TaskController@trackSkip', $idea->id) }}").submit();

            // console.log("test");

            // var speed = 400;

            // if ($('.activity #idea').length > 0) {
            //     $('#task-panel').fadeTo(speed, 0);
            //     $('.activity #idea').delay(speed).fadeTo(speed, 0, function() {
            //         $('#waiting').show();
            //         // window.location.assign("{{ route('do') }}");
            //     });
            // }
            // else {
            //     $('#task-panel').fadeTo(speed, 0, function() {
            //         $('#waiting').show();
            //         // window.location.assign("{{ route('do') }}");
            //     });
            // }
        }
    </script>
@endsection
