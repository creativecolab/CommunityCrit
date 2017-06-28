@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        @component('tasks.common.microtask')
            @slot('title')
                {{ $task->name }}
            @endslot

            @slot('text')
                {{ $task->text }}
            @endslot
        @endcomponent
    @endforeach
@endsection
