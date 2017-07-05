@extends('layouts.app')

@section('content')
    {{--Could be made more efficient--}}
    @foreach($tasks as $task)
        @if($recommendations->contains($task->id))
        @component('tasks.common.microtask', ['id' => $task->id, 'subtasks' => $task->getImmediateDescendants(), 'recommended' => $recommendations->contains($task->id), 'recommendations' => $recommendations])
            @slot('title')
                {{ $task->name }}
            @endslot

            @slot('text')
                {!! html_entity_decode($task->text) !!}
            @endslot
        @endcomponent
        @endif
    @endforeach
    @foreach($tasks as $task)
        @if(!($recommendations->contains($task->id)))
            @component('tasks.common.microtask', ['id' => $task->id, 'subtasks' => $task->getImmediateDescendants(), 'recommended' => $recommendations->contains($task->id), 'recommendations' => $recommendations])
            @slot('title')
            {{ $task->name }}
            @endslot

            @slot('text')
            {!! html_entity_decode($task->text) !!}
            @endslot
            @endcomponent
        @endif
    @endforeach
@endsection
