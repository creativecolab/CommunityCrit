{!! Form::open(['action' => ['TaskController@storeFeedback', $id]]) !!}
<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
    {!! Form::label('comment', 'Share Your Thoughts:') !!}
    {!! Form::textarea('comment', '', ['class' => 'form-control', 'required' => 'true']) !!}

    @if ($errors->has('comment'))
        <span class="help-block">
            <strong>{{ $errors->first('comment') }}</strong>
        </span>
    @endif
</div>
{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
{!! Form::close() !!}
