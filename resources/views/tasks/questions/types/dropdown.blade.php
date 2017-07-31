{!! Form::open(['action' => ['TaskController@storeResponse', $id]]) !!}
<div class="form-group">
    <label class="col-md-4 control-label">{{ $text }}</label>
    <div class="col-md-8">
        <div class="form-group">
        <select name="dropdown" class="form-control">
        @foreach($options as $option)
            <option>{{$option->text}}</option>
        @endforeach
        </select></div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
    </div>
</div>
{!! Form::close() !!}

{{--{!! Form::open(['action' => ['SurveyController@storeResponse', $page]]) !!}--}}
{{--<div class="form-group">--}}
    {{--<label for="neighborhood" class="col-md-4 control-label">Which neighborhood do you live in?</label>--}}
    {{--<div class="col-md-8">--}}
        {{--<select id="neighborhood" name="neighborhood" class="form-control">--}}
            {{--<option>(select one)</option>--}}
            {{--<option>Barrio Logan</option>--}}
            {{--<option>East Village</option>--}}
            {{--<option>Ballpark Village</option>--}}
            {{--<option>Bay Park</option>--}}
            {{--<option>Center City</option>--}}
            {{--<option>Cortez Hill</option>--}}
            {{--<option>Del Mar</option>--}}
            {{--<option>Downtown Marina District</option>--}}
            {{--<option>Golden Hill</option>--}}
            {{--<option>Hillcrest</option>--}}
            {{--<option>Logan Heights</option>--}}
            {{--<option>Marina</option>--}}
            {{--<option>North Park</option>--}}
            {{--<option>South Park</option>--}}
            {{--<option>Talmadge</option>--}}
            {{--<option>(other)</option>--}}
            {{--<!-- <option>Outside of San Diego</option> -->--}}
        {{--</select>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
    {{--<div class="col-md-6 col-md-offset-4">--}}
        {{--{!! Form::submit('Next', ['class' => 'btn btn-primary']) !!}--}}
        {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
    {{--</div>--}}
{{--</div>--}}
{{--{!! Form::close() !!}--}}