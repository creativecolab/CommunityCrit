{!! Form::open(['action' => ['TaskController@storeResponse', $id]]) !!}
<div class="form-group">
    <label class="col-md-4 control-label">{{ $text }}</label>
    <div class="col-md-8">
        @foreach($options as $option)
            <div class="form-group">
                <label>
                    {{$option->text}}
                </label>
                {!! Form::textarea($option->text, '', ['class' => 'form-control', 'required' => 'true', 'rows' => 2]) !!}
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
