@extends('layouts.app')

@section('title', 'Dev')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <div class="panel-heading">Help Us Find the Right Info for You {{$test}}</div>
                <div class="panel-body">

                    {{--@component('proto.testoptions', ['text' => $task->text, 'options' => $options, 'task' => $task->id])--}}
                    {{--@endcomponent--}}
                    @component('proto.microtask', ['text' => $task->text, 'id' => $task->id, 'name' => $task->name, 'test' => $test])
                    @endcomponent

                </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
