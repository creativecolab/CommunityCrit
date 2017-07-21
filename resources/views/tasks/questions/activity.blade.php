@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <div class="panel-heading">Topic - Design_Idea</div>
                <div class="panel-body">

                    @if($options->isEmpty())
                        @component('tasks.questions.template', ['id' => $task->id, 'name' => $task->name, 'text' => $task->text])
                        @endcomponent
                    @elseif(!$options->isEmpty())
                        @component('tasks.questions.options', ['id' => $task->id, 'text' => $task->text, 'options' => $options])
                        @endcomponent
                    @endif

                </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
