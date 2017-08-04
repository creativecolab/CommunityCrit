<div class="panel panel-default" style="opacity: 0;" id="idea">
    <div class="panel-body">
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
        <h2 style="margin-top: 12.5px;">
        Idea<!-- 
        -->@if ($idea->name)<!-- 
             -->: {!! $idea->name !!}
        @endif
        <!-- <button class="btn btn-default pull-right">Switch idea</button> -->
        </h2>
        {!! $idea->text !!}
        <!-- <p><em>Suggested by {{ $idea->user->fname }}</em></p> -->
    </div>
        @if ($link->id)
            <ul class="list-group" id="link">
                <li class="list-group-item">
                    @component('activities.common.link', ['link' => $link])
                    @endcomponent
                </li>
            </ul>
        @endif
</div>