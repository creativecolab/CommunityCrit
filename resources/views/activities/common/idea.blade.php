<h2 style="margin-top: 12.5px;">
Idea<!-- 
-->@if ($idea->name)<!-- 
     -->: {!! $idea->name !!}
@endif
<!-- <button class="btn btn-default pull-right">Switch idea</button> -->
</h2>
<p><em>Submitted by 
@if ($idea->user->id == 3)
    a <strong>{{ strtolower($idea->user->fname) }}.</strong>
@else
    <strong>{{ $idea->user->fname }}.</strong>
@endif
</em></p>
<!-- @if ($idea->img_url) -->
    <!-- <div class="idea-img" style=""> -->
    <!-- <div class="col-md-3"> -->
        <!-- <img class="img-responsive" src="{!! $idea->img_url !!}"></img> -->
    <!-- </div> -->
    <!-- <div class="col-md-9"> -->
    <!-- </div> -->
    <!-- <div class="idea-name-text"> -->
<!-- @else -->
    <!-- <div style="max-width: 100%;"> -->
<!-- @endif -->
<p>{!! $idea->text !!}</p>
<!-- <p><em>Suggested by {{ $idea->user->fname }}</em></p> -->