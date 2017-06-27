@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $task->name }}
                    </div>

                    <div class="panel-body">
                        {{ $task->text }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
