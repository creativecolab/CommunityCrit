<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        <p><em>The following idea was submitted by
        @if ($idea->user->id == 3)
            a <strong>{{ strtolower($idea->user->fname) }}.</strong>
        @else
            <strong>{{ $idea->user->fname }}.</strong>
        @endif
        Please help to improve it below.</em></p>
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
            <h2>
            Idea<!-- 
            -->@if ($idea->name)<!-- 
                 -->: {!! $idea->name !!}
            @endif
            <!-- <button class="btn btn-default pull-right">Switch idea</button> -->
            </h2>
            <p>{!! $idea->text !!}</p>
            <!-- <p><em>Suggested by {{ $idea->user->fname }}</em></p> -->
        </div>
    </div>
</div> <!-- .row -->    