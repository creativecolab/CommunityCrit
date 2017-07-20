@extends('layouts.app')

@section('title', 'Dev')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Submit a new task</div>
                    <div class="panel-body">
                        {{--<form role="form" class="form-horizontal">--}}
                        {!! Form::open(['action' => ['TaskController@newTask']]) !!}
                        <div class="form-group">
                            {{--{!! Form::textarea('name', '', ['class' => 'form-control', 'required' => 'true']) !!}--}}
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter question name (opt)">
                            {!! Form::textarea('text', '', ['class' => 'form-control', 'required' => 'true', 'placeholder' => 'Enter question text']) !!}
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
