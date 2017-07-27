@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <div class="panel-heading">Project - Topic</div>
                <div class="panel-body">

                    @if($options->isEmpty())
                        @component('tasks.questions.types.freetext', ['id' => $task->id, 'name' => $task->name, 'text' => $task->text])
                        @endcomponent
                    @elseif(!$options->isEmpty())
                        @if($task->type == 2)
                            @component('tasks.questions.types.radio', ['id' => $task->id, 'text' => $task->text, 'options' => $options])
                            @endcomponent
                        @elseif($task->type == 4)
                            @component('tasks.questions.types.checkboxes', ['id' => $task->id, 'text' => $task->text, 'options' => $options])
                            @endcomponent
                        @elseif($task->type == 5)
                            @component('tasks.questions.types.multitext', ['id' => $task->id, 'text' => $task->text, 'options' => $options])
                            @endcomponent
                        @elseif($task->type == 6)
                            @component('tasks.questions.types.dropdown', ['id' => $task->id, 'text' => $task->text, 'options' => $options])
                            @endcomponent
                        @endif
                    @endif

                </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
@endsection
