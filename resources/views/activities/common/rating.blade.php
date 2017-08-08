<div style="margin-bottom: 10px;">
    @foreach($qualities as $key=>$quality)
        <div class="row">
            <div class="col-md-12 form-group{{ $errors->has($quality) ? ' has-error' : '' }}">
                <label class="control-label" style="margin-right: 10px;">Not {{$quality}} at all</label>
                {{--Checkbox for each idea--}}
                @for($i = 1; $i < 6; $i++)
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio($quality, $i) !!}
                            {{$i}}
                        </label>
                    </div>
                @endfor
                <label class="control-label" style="margin-left: 10px;">Extremely {{$quality}}</label>
                @if ($errors->has($quality))
                    <div class="col-md-12 help-block">
                        <strong>{{ $errors->first($quality) }}</strong>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>