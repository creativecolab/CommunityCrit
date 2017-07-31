@extends('layouts.app')

@section('title', 'Combination')

@section('content')

    {!! Form::open(['action' => ['IdeaController@combine']]) !!}
    <div class="form-group">
        <label class="col-md-4 control-label">Select similar ideas:</label>
        <div class="col-md-8">
            {{--Checkbox for each idea--}}
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
        <label class="col-md-4 control-label">Name your new idea</label>
        <div class="col-md-6">
            {!! Form::textarea('name', '', ['class' => 'form-control', 'required' => 'true', 'rows' => 1]) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
        </div>
    </div>
    {!! Form::close() !!}
    <div class="form-group">
        <a type="button" class="btn btn-primary" href="#">Skip</a>
    </div>
@endsection
