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
                                <label class="col-md-4 control-label">Which option best describes your relation to the Park to Park project?</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios1" value="1">
                                            Resident
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios2" value="2">
                                            Observer
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios3" value="3">
                                            Project Organizer
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios4" value="4">
                                            City Planner
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios5" value="5">
                                            Developer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Next', ['class' => 'btn btn-primary']) !!}
{{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->

    </div> <!-- .container -->
@endsection
