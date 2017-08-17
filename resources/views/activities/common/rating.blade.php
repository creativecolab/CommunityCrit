<div style="margin-bottom: 10px;">
    @foreach($qualities as $key=>$quality)
        <div class="row">
            <div class="form-group{{ $errors->has($quality) ? ' has-error' : '' }}">
                @if ($word)
                    <label class="col-md-4 col-lg-4 control-label">It is not {{$mapped_qualities[$key]}} at all</label>
                @else
                    <label class="col-md-4 col-lg-4 control-label">I am not {{$mapped_qualities[$key]}} at all</label>
                @endif
                <div class="col-md-4 col-lg-3">
                    {{--Checkbox for each idea--}}
                    @for($i = 1; $i < 6; $i++)
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio($quality, $i) !!}
                                {{$i}}
                            </label>
                        </div>
                    @endfor
                </div>
                @if ($word)
                    <label class="col-md-4 col-lg-5 control-label">It is extremely {{$mapped_qualities[$key]}}</label>
                @else
                    <label class="col-md-4 col-lg-5 control-label">I am extremely {{$mapped_qualities[$key]}}</label>
                @endif
                @if ($errors->has($quality))
                    <div class="col-md-12 help-block">
                        <strong>{{ $errors->first($quality) }}</strong>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    @if($task->type == 103 || $task->type == 104)
    <div class="row">
        @if ($errors->has('text'))
            <span class="help-block">
                <strong>{{ $errors->first('text') }}</strong>
            </span>
        @endif
        @if($qualities->count() > 1)
            <label>Explain your thoughts.</label>
            {{ Form::textarea('text', '', array('class' => 'form-control', 'id' => 'submissionText', 'rows' => '3', 'placeholder' => "Please enter your reason here.")) }}
        @else
            {{ Form::hidden('require-check', 'yes') }}
            {{ Form::textarea('text', '', array('class' => 'form-control', 'id' => 'submissionText', 'rows' => '3', 'placeholder' => "Please enter your reason here.")) }}
        @endif
    </div>
    @endif
</div>