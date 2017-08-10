<div style="margin-bottom: 10px;">
    @foreach($qualities as $key=>$quality)
        <div class="row">
            <div class="form-group{{ $errors->has($quality) ? ' has-error' : '' }}">
                <label class="col-md-4 col-lg-4 control-label">I am not {{$mapped_qualities[$key]}} at all</label>
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
                <label class="col-md-4 col-lg-5 control-label">I am extremely {{$mapped_qualities[$key]}}</label>
                @if ($errors->has($quality))
                    <div class="col-md-12 help-block">
                        <strong>{{ $errors->first($quality) }}</strong>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>