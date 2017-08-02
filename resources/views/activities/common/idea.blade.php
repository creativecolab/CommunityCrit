<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        @if ($idea->img_url)
            <div class="idea-img" style="">
            <!-- <div class="col-md-3"> -->
                <img class="img-responsive" src="{!! $idea->img_url !!}"></img>
            <!-- </div> -->
            <!-- <div class="col-md-9"> -->
            </div>
            <div class="idea-name-text">
        @else
            <div style="max-width: 100%;">
        @endif
            <h2 class="no-marg-top">
            Idea<!-- 
            -->@if ($idea->name)<!-- 
                 -->: {!! $idea->name !!}
            @endif
            <!-- <button class="btn btn-default pull-right">Switch idea</button> -->
            </h2>
            <p style="font-size: 120%;">{!! $idea->text !!}</p>
            <p><em>Suggested by {{ $idea->user->fname }}</em></p>
        </div>
    </div>
</div> <!-- .row -->