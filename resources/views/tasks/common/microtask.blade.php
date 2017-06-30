<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $title }}@if(isset($recommended) && $recommended) <span class="label label-primary">Recommended for You</span>@endif
            </div>

            <div class="panel-body">
                {{ $text }}

                @if( isset($subtasks) )
                    @foreach ($subtasks as $subtask)
                        <strong>{{ $subtask->name }}</strong>

                        <p>{!! html_entity_decode($subtask->text) !!}</p>
                    @endforeach
                @endif
            </div>

            <div class="panel-footer">
                @component('tasks.common.feedbackForm', ['id' => $id])
                @endcomponent
            </div>
        </div>
    </div>
</div>
