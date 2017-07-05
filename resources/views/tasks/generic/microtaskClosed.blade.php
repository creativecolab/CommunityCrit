@extends('layouts.app')

@section('title', 'Tasks |')

@section('content')
    @component('tasks.common.microtask', ['id' => $task->id])
        @slot('title')
            {{ $task->name }}
        @endslot

        @slot('text')
            {!! html_entity_decode($task->text) !!}
        @endslot
    @endcomponent
@endsection
