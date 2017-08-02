<div class="row" style="margin-bottom: 10px;">
    @foreach($qualities as $key=>$quality)
        <div class="form-group{{ $errors->has($quality) ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Not {{$quality}} at all</label>
            <div class="col-md-3">
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
            <label class="col-md-7 control-label">Extremely {{$quality}}</label>
            @if ($errors->has($quality))
                <div class="col-md-12 help-block">
                    <strong>{{ $errors->first($quality) }}</strong>
                </div>
            @endif
        </div>
    @endforeach
</div>