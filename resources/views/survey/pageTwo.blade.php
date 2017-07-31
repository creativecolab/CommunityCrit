@extends('layouts.app')

@section('title', 'Survey')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Us Find the Right Info for You</div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['SurveyController@storeResponse', $page]]) !!}
                            <div class="form-group">
                                <label for="neighborhood" class="col-md-4 control-label">Which neighborhood do you live in?</label>
                                <div class="col-md-8">
                                    <select id="neighborhood" name="neighborhood" class="form-control" onchange="otherNeighbor()">
                                        <option>(select one)</option>
                                        <option>Barrio Logan</option>
                                        <option>East Village</option>
                                        <option>Ballpark Village</option>
                                        <option>Bay Park</option>
                                        <option>Center City</option>
                                        <option>Cortez Hill</option>
                                        <option>Del Mar</option>
                                        <option>Downtown Marina District</option>
                                        <option>Golden Hill</option>
                                        <option>Hillcrest</option>
                                        <option>Logan Heights</option>
                                        <option>Marina</option>
                                        <option>North Park</option>
                                        <option>South Park</option>
                                        <option>Talmadge</option>
                                        <option>(other)</option>
                                        <!-- <option>Outside of San Diego</option> -->
                                        @include('tasks.scripts', ['test' => 0])
                                    </select>
                                </div>

                                <div class="col-md-8 col-md-offset-4" id="neighOtherFG" style="display: none;">
                                    <input type="text" class="form-control" name="otherHood" id="neighborhoodOther" placeholder="Enter another neighborhood">
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
