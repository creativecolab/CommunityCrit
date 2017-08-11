@foreach($actions as $key=>$action)
    <div class="form-group{{ $errors->has($action) ? ' has-error' : '' }}">
        {{--Radio for each item--}}
        <div class="radio-inline">
            <label>
                {!! Form::radio('pending-mod' + $idea->id, $key) !!}
                {{$action}}
            </label>
        </div>
    </div>
@endforeach