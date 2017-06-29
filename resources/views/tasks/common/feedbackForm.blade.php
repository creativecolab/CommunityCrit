{!! Form::open(['action' => ['TaskController@storeFeedback', $id]]) !!}
<div class="form-group">
    {!! Form::label('comment', 'Share Your Thoughts:') !!}
    {!! Form::textarea('comment', '', ['class' => 'form-control']) !!}
</div>
{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
{!! Form::close() !!}
