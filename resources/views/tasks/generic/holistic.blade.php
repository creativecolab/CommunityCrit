@extends('layouts.app')

@section('title', 'Tasks |')

@section('content')
    @foreach($tasks as $task)
        <div class="row">
            <div class="col-xs-12">
                <h2>{{ $task->name }}</h2>

                <p>{!! html_entity_decode($task->text) !!}</p>


                @foreach($task->getImmediateDescendants() as $subtask)
                    <strong>{{ $subtask->name }}</strong>

                    <p>{!! html_entity_decode($subtask->text) !!}</p>
                @endforeach

            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-xs-12">
            <h2>Feedback</h2>

            @component('tasks.common.feedbackForm', ['id' => $rootTask->id])
            @endcomponent
        </div>
    </div>
@endsection
