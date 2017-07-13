@extends('layouts.app')

@section('title', 'Survey')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Us Find the Right Info for You</div>
                    <div class="panel-body">
                        <form role="form" action="detail.htm" class="form-horizontal">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">What interests you about the Park to Park project?</label>

                                <div class="col-md-8">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Activity Engagement
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Connecting Neighborhoods
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Culture and Heritage
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Economy
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Mobility
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Property Ownership
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Public Facilities
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Street Character
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Sustainability
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Urban Design
                                        </label>
                                    </div>

                                </div> <!-- .col -->
                            </div> <!-- .form-group -->

                            <div class="form-group">
                                <label for="neighborhood" class="col-md-4 control-label">Which neighborhood do you live in?</label>
                                <div class="col-md-8">
                                    <select id="neighborhood" class="form-control" onchange="otherNeighbor()">
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
                                    <input type="text" class="form-control" id="neighborhoodOther" placeholder="Enter another neighborhood">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Which option best describes your relation to the Park to Park project?</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios1" value="option1">
                                            Resident
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios2" value="option2">
                                            Observer
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios3" value="option3">
                                            Project Organizer
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios4" value="option4">
                                            City Planner
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="relation" id="optionsRadios5" value="option5">
                                            Developer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">How familiar are you with the Park to Park project?</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarProj" id="optionsRadios1" value="option1">
                                            I’ve never heard of the project
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarProj" id="optionsRadios2" value="option2">
                                            I’ve heard of the project
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarProj" id="optionsRadios3" value="option3">
                                            I’ve been to a meeting about the project
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarProj" id="optionsRadios3" value="option3">
                                            I’ve been to multiple meetings about the project
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarProj" id="optionsRadios4" value="option4">
                                            I’m helping to organize or plan the project
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Rate your knowledge of community and urban planning.</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios1" value="option1">
                                            No knowledge of urban planning
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios2" value="option2">
                                            I know a little bit about urban planning but have not attended a workshop
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios3" value="option3">
                                            I’ve been to a few urban planning workshops
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios4" value="option4">
                                            I have studied urban planning
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="familiarUD" id="optionsRadios5" value="option5">
                                            I practice as an urban planner
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a type="submit" class="btn btn-primary" href="{{ action('TaskController@allFacets') }}">Get Started</a>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->

    </div> <!-- .container -->
@endsection
