@extends('layouts.app')

@section('title')
    {!! $task->name !!}
@endsection

@section('content')
    <!-- standby instruction -->
    <!-- <h4 class="text-center" id="waiting">
        Finding an activity for you...
    </h4> -->

    {{--{{ \Session::put('time1',new \Carbon\Carbon()) }}--}}

    <div class="activity" id="text-link">
            <a type="button" class="btn btn-default" id="back" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Do An Activity</a>

        <a type="button" class="btn btn-default" data-toggle="collapse" href="#collapseOverview" aria-expanded="false" aria-controls="collapseOverview" id="overview-btn" onclick="overview_onClick()"><span id="overview-btn-instr">Show</span> El Nudillo Overview</a>

        <div class="panel panel-default collapse" id="collapseOverview">
            <div class="panel-body" id="overview">
                <div class="row">
                    <div class="col-sm-4">
                        <figure>
                            <a href="{{ asset('img/ElNudillo1.jpg') }}" data-imagelightbox="j">
                                <img src="{{ asset('img/ElNudillo1.jpg') }}" alt="Overhead View of the El Nudillo Intersection" class="img-responsive shdw">
                            </a>
                            <!-- <figcaption>El Nudillo will mark the end of the 14th Street Promenade.</figcaption> -->
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <div class="about">
                            <h3>About El Nudillo</h3>
                            @if ( !empty($task) && !empty($idea) && empty($aosifda))
                            <p>{{$task->id}}</p>
                            <p>{{$idea->name}}</p>
                            @endif
                            <p>The concept of El Nudillo was created during two workshops held in East Village last year. El Nudillo—Spanish for "joint" or "knuckle"—is where 14th Street ends at the trolley tracks on Commercial Street, just at the intersection of National Avenue. This is also where the familiar north-south, east-west grid pattern of downtown streets turns 45 degrees, and where four MTS bus routes currently stop. Finally, El Nudillo marks the transition between downtown and Barrio Logan.</p>
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
                @if (intval(($task->type) / 10) == 4)
                    <h4>Submit A New Idea</h4>
                @else
                    <h4>Question {{\Session::get('t_ptr')}}/5</h4>
                @endif
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
                        {!! Form::open(['action' => ['TaskController@submitIdea'], 'style' => 'display:inline', 'id' => 'task-form', 'files' => 'true']) !!}
                        <!-- <em>Submission!</em> -->
                    @elseif (intval(($task->type) / 10) == 7)
                        {!! Form::open(['action' => ['TaskController@submitLink'], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                        <!-- <em>Link!</em> -->
                    @elseif ($task->type == 100)
                        {!! Form::open(['action' => ['TaskController@submitRatings'], 'style' => 'display:inline', 'id' => 'task-form']) !!}
                    @elseif ($task->type == 62)
                        {!! Form::open(['action' => ['TaskController@submitQuestion', $idea->id], 'style' => 'display:inline', 'id' => 'task-form']) !!}
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
                            <!-- <textarea class="form-control" rows="3" id="submissionText" name="text" value="{{ old('text') }}" placeholder="Please enter your response here." required></textarea> -->
                            @if ($task->type != 62)
                                {{ Form::textarea('text', '', array('class' => 'form-control', 'id' => 'submissionText', 'rows' => '3', 'placeholder' => "Please enter your response here.")) }}
                            @else
                                {{ Form::textarea('text', '', array('class' => 'form-control', 'id' => 'submissionText', 'rows' => '3', 'placeholder' => "Please enter your question here.")) }}
                            @endif
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
                                    <!-- <input type="text" class="form-control" name="name" required></input> -->
                                    {{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => "Name your idea.", 'type' => 'text')) }}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> <!-- .col -->
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                    <label class="instruction" for="submissionText">(Optional) Upload a main image</label>
                                    {!! Form::file('photo', ['id' => 'photosub']) !!}

                                    @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->get('extra.*'))
                                    @foreach($errors->get('extra.*') as $er)
                                        @foreach($er as $msg)
                                        <span class="help-block">
                                            <strong>{{ $msg }}</strong>
                                        </span>
                                        @endforeach
                                    @endforeach
                                    @endif
                                </div>
                            </div> <!-- .col -->
                        </div>

                        <div class="row" id="extradiv" style="display:none">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                                    <label class="instruction" for="submissionText">(Optional) Upload extra images</label>

                                    {!! Form::file('extra[]', ['multiple' => 'multiple', 'id' => 'extrasub', 'style' => 'display:none']) !!}
                                    @if ($errors->has('extra[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('extra[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
