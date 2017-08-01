@extends('layouts.app')

@section('title', 'Survey')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Us Find the Right Info for You</div>
                    <div class="panel-body">
                        {{--<form role="form" class="form-horizontal">--}}
                        {!! Form::open(['action' => ['SurveyController@storeResponse', $page]]) !!}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Rate your knowledge of community and urban planning.</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios1" value="1">
                                            No knowledge of urban planning
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios2" value="2">
                                            I know a little bit about urban planning but have not attended a workshop
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios3" value="3">
                                            I’ve been to a few urban planning workshops
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios4" value="4">
                                            I have studied urban planning
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios5" value="5">
                                            I practice as an urban planner
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Next', ['class' => 'btn btn-primary']) !!}
                                    {{--<a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->

    </div> <!-- .container -->
@endsection
