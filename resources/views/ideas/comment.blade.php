@extends('layouts.app')

@section('title', 'Commenting')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['action' => ['IdeaController@comment', $idea->id]]) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ $idea->text }}</label>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>
                                        Comment on this idea
                                    </label>
                                    {!! Form::textarea('text', '', ['class' => 'form-control', 'required' => 'true', 'rows' => 2]) !!}
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

                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
