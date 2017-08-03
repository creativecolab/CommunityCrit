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
                                <label for="email" class="col-md-4 control-label">What interests you about the Park to Park project?</label>

                                <div class="col-md-8">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="activity" value="1">
                                            Activity Engagement
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="neighbor" value="2">
                                            Connecting Neighborhoods
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="culture" value="3">
                                            Culture and Heritage
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="economy" value="4">
                                            Economy
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mobility" value="5">
                                            Mobility
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="property" value="6">
                                            Property Ownership
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="facilities" value="7">
                                            Public Facilities
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="street" value="8">
                                            Street Character
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sustainability" value="9">
                                            Sustainability
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="urban" value="10">
                                            Urban Design
                                        </label>
                                    </div>

                                </div> <!-- .col -->
                            </div> <!-- .form-group -->


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Next', ['class' => 'btn btn-primary']) !!}
                                    {{--<a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        {{--</form>--}}
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->

    </div> <!-- .container -->
@endsection
