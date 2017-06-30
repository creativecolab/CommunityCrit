@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        @component('tasks.common.microtask', ['id' => $task->id, 'subtasks' => $task->subtasks, 'recommended' => $recommendations->contains($task->id), 'recommendations' => $recommendations])
            @slot('title')
                {{ $task->name }}
            @endslot

            @slot('text')
                {!! html_entity_decode($task->text) !!}
            @endslot
        @endcomponent
    @endforeach
@endsection
