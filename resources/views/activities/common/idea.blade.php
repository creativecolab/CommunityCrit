<div id="text">
    <h2>
    Idea<!-- 
    -->@if ($idea->name)<!-- 
         -->: {!! $idea->name !!}
    @endif
    </h2>
    <p><em>Submitted by 
    @if ($idea->user->id == 3 || $idea->user->fname == 'Guest')
        a <strong>{{ strtolower($idea->user->fname) }}</strong>.
    @else
        <strong>{{ $idea->user->fname }}</strong>.
    @endif
    </em></p>
    <p>{!! $idea->text !!}</p>
    @if(!$extra_images->isEmpty())
        <ul style="display:none">
            @foreach($extra_images as $image)
                <li><a href="{{$image}}" data-imagelightbox="h"><img src="{{$image}}"></a></li>
            @endforeach
            {{--<li><a href="{{'/img/vector-map.png'}}" data-imagelightbox="h"><img src="{{'/img/favicon.ico'}}"></a></li>--}}
            {{--<li><a href="{{'/img/ElNudillo1.jpg'}}" data-imagelightbox="h"><img src="{{'/img/favicon.ico'}}"></a></li>--}}
            {{--<li><a href="{{'/img/timeline.png'}}" data-imagelightbox="h"><img src="{{'/img/favicon.ico'}}"></a></li>--}}
        </ul>
        <button class="btn btn-default btn-sm trigger_lightbox">View additional images</button>
    @endif
</div>
@if ($idea->img_url)
    <div id="img">
        <a href="{{ $idea->img_url }}" data-imagelightbox="a"><img src="{{ $idea->img_url }}"></a>
    </div>
    <div class="clearfix"></div>
@endif