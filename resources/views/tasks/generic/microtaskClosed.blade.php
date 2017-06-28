@extends('layouts.app')

@section('content')
    @component('tasks.common.microtask')
        @slot('title')
            {{ $task->name }}
        @endslot

        @slot('text')
            {{ $task->text }}
        @endslot
    @endcomponent
@endsection
