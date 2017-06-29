@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        <div class="row">
            <div class="col-xs-12">
                <h2>{{ $task->name }}</h2>

                <p>{!! html_entity_decode($task->text) !!}</p>

                @if($task->hasSubtasks())
                    @foreach($task->subtasks as $subtask)
                        <strong>{{ $subtask->name }}</strong>

                        <p>{!! html_entity_decode($subtask->text) !!}</p>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-xs-12">
            <h2>Feedback</h2>
            {!! Form::open() !!}
            <div class="form-group">
                {!! Form::label('feedback', 'Share Your Thoughts:') !!}
                {!! Form::textarea('feedback', '', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
