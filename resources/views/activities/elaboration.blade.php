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
        {{ $count = count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 3) }}
    </div>

    <div class="activity" id="text-link">
        {{--@if ($count >= 4)--}}
            <a type="button" class="btn btn-default" id="back" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Do An Activity</a>
        {{--@endif--}}

        <a type="button" class="btn btn-default pull-right" data-toggle="collapse" href="#collapseOverview" aria-expanded="false" aria-controls="collapseOverview" id="overview-btn" onclick="overview_onClick()"><span id="overview-btn-instr">Show</span> El Nudillo Overview</a>

        <div class="panel panel-default collapse" id="collapseOverview">
            <div class="panel-body" id="overview">
                <div class="row">
                    <div class="col-md-4">
                        <figure>
                            <img src="{{ asset('img/ElNudillo1.png') }}" alt="project map" class="img-responsive shdw">
                            <!-- <figcaption>El Nudillo will mark the end of the 14th Street Promenade.</figcaption> -->
                        </figure>
                    </div>
                    <div class="col-md-8">
                        <div class="about">
                            <h3>About El Nudillo</h3>
                            <p>In the EVS workshops held last year, the concept of El Nudillo was created. Spanish for joint or knuckle, this is the place where 14th Street ends at the trolley tracks on Commercial Street just at the intersection of National Avenue. This is where the familiar N-S, E-W grid pattern of downtown streets turns 45 degrees. Both literally and figuratively, El Nudillo is the joining point of downtown and the barrio.</p>
                            <p>Folks in this workshop further noted that, with the MTS building/station and Greyhound Bus terminal at El Nudillo, it would make a great spot for a transit hub. Also, four MTS bus routes currently stop there.<p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>

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
                    @if (intval($task->type) / 10 == 4)
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="instruction" for="submissionText">Give your idea a name.</label>
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

                    {{--<!-- linking task -->
                    @if ((intval($task->type / 10) == 7) && ($task->text2))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="instruction" for="submissionText">{{ $task->text2 }} <span class="text-muted">(optional)</span></label>
                                    <input type="text" class="form-control" name="text2"></input>
                                </div>
                            </div> <!-- .col -->
                        </div>
                    @endif--}}

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
                    
                        @component('activities.common.modal', ['submit' => true ])
                        @endcomponent
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
