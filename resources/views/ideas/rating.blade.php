@extends('layouts.app')

@section('title', 'Combination')

@section('content')

    {!! Form::open(['action' => ['IdeaController@assess', $idea->id]]) !!}
    <div class="form-group">
        @foreach($ratings as $rating)
        <label class="col-md-4 control-label">Rate on {{$rating}}:</label>
        <div class="col-md-8">
            {{--Checkbox for each idea--}}
            @for($i = 1; $i < 6; $i++)
                <div class="radio-inline">
                    <label>
                        {!! Form::radio($rating, $i) !!}
                        {{$i}}
                    </label>
                </div>
            @endfor

        </div>
        @endforeach
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
