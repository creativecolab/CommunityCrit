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
</div>
@if ($idea->img_url)
    <div id="img">
        <img src="{{ $idea->img_url }}">
    </div>
    <div class="clearfix"></div>
@endif