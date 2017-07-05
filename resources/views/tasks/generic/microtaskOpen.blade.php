@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    @foreach($tasks as $task)
        @component('tasks.common.microtask', ['id' => $task->id, 'subtasks' => $task->getImmediateDescendants()])
            @slot('title')
                {{ $task->name }}
            @endslot

            @slot('text')
                {!! html_entity_decode($task->text) !!}
            @endslot
        @endcomponent
    @endforeach
@endsection
