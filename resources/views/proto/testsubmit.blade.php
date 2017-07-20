@extends('layouts.app')

@section('title', 'Dev')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Us Find the Right Info for You {{$test}}</div>
                    <div class="panel-body">
                        {{--<form role="form" class="form-horizontal">--}}
                        {!! Form::open(['action' => ['TaskController@testStoreResponse', $task]]) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ $text }}</label>
                            <div class="col-md-8">
                                @foreach($options as $option)
                                    <div class="radio">
                                        <label>
                                            {!! Form::radio('option', $option->text) !!}
                                            {{$option->text}}
                                        </label>
                                    </div>
                                @endforeach
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
