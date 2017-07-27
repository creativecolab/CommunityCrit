@extends('layouts.app')

@section('title', 'Submit Idea')

@section('content')
    {!! Form::open(['action' => ['IdeaController@submitIdea']]) !!}
    <div class="form-group">
        <label>Submit an Idea</label>
        {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 1, 'required' => true]) !!}
    </div>
    <div class="form-group">
        <div>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-left']) !!}
            {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
        </div>
    </div>
    {!! Form::close() !!}
    <a type="button" class="btn btn-primary" href="#">Skip</a>
@endsection
