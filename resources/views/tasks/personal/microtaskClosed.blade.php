@extends('layouts.app')

@section('title', 'Task |')

@section('content')
    @component('tasks.common.microtask', ['id' => $task->id, 'recommended' => true])
        @slot('title')
            {{ $task->name }}
        @endslot

        @slot('text')
            {!! html_entity_decode($task->text) !!}
        @endslot
    @endcomponent
@endsection
