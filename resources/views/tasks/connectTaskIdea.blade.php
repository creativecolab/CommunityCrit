@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    {!! Form::open(['action' => ['TaskController@connectTaskIdea', $id]]) !!}
    <div class="form-group">
        <label class="col-md-4 control-label">Choose ideas to connect</label>
        <div class="col-md-8">
            @foreach($ideas as $idea)
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox($idea->id, $idea->id) !!}
                        {{$idea->text}}
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
@endsection
