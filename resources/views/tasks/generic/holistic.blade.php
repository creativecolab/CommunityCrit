@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        <div class="row">
            <div class="col-xs-12">
                <h2>{{ $task->name }}</h2>

                <p>{{ $task->text }}</p>
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
