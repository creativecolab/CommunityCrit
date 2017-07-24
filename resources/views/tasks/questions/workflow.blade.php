@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['action' => ['TaskController@dashboard']]) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Select a project and topic</label>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select required id="projects" name="dropdown" class="form-control" onchange="showTopics()">
                                        <option value="">(select one)</option>
                                        @foreach($projects as $project)
                                            <option>{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select required id="topics" name="dropdown" class="form-control" style="display:none">
                                        <option value="">(select one)</option>
                                        @foreach($topics as $topic)
                                            <option style="">{{$topic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .container -->
    <script>
        function showTopics() {
            var selectVal = document.getElementById("projects").value;
            var $otherInput = $('#topics');
            if (selectVal != "") {
                $($otherInput).show();
            } else {
                $($otherInput).hide();
            }
        }
    </script>
@endsection
