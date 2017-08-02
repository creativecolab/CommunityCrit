@extends('layouts.app')

@section('title', 'Rating')

@section('content')

    {!! Form::open(['action' => ['IdeaController@assess', $idea->id]]) !!}
    <div class="row">
        <div class="form-group">
            @foreach($ratings as $rating)
            <label class="col-md-2 control-label">Not {{$rating}} at all</label>
            <div class="col-md-3">
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
            <label class="col-md-7 control-label">Extremely {{$rating}}</label>
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
    <div class="form-group">
        <a type="button" class="btn btn-primary" href="#">Skip</a>
    </div>
@endsection
