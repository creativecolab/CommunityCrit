<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $title }}
            </div>

            <div class="panel-body">
                {{ $text }}
            </div>

            <div class="panel-footer">
                {!! Form::open() !!}
                <div class="form-group">
                    {!! Form::label('feedback', 'Share Your Thoughts:') !!}
                    {!! Form::textarea('feedback', '', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
