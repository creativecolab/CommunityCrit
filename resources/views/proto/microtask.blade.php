<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {!! $name !!} {{$test}}
            </div>

            <div class="panel-body">
                {!! $text !!}

                {{--@if( isset($subtasks) )--}}
                {{--@foreach ($subtasks as $subtask)--}}
                {{--<strong>{{ $subtask->name }}@if(isset($recommendations) && $recommendations->contains($subtask->id))--}}
                {{--<span class="label label-primary">Recommended for You</span>@endif</strong>--}}
                {{--<p>{!! html_entity_decode($subtask->text) !!}</p>--}}
                {{--@endforeach--}}
                {{--@endif--}}
            </div>

            <div class="panel-footer">
                <form></form>
                {!! Form::open(['action' => ['TaskController@testStoreResponse', $id], 'style' => 'display:inline']) !!}
                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    {!! Form::label('comment', 'Share Your Thoughts:') !!}
                    <textarea class="form-control" name="type" id="type" style="display:none;">custom</textarea>
                    {!! Form::textarea('input1', '', ['value' => 'custom', 'class' => 'form-control', 'required' => 'true']) !!}

                @if ($errors->has('comment'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                </div>
                {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
                {{--{!! Form::submit('Skip', ['class' => 'btn btn-default pull-right']) !!}--}}
                {!! Form::close() !!}

                {!! Form::open(['action' => ['TaskController@skipQuestion', $id], 'style' => 'display:inline']) !!}
                {!! Form::submit('Skip', ['class' => 'btn btn-default pull-right']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
