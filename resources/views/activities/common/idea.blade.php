<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        @if ($idea->img_url)
            <div style="float: left; margin-right: 22px; max-width: 30%;">
            <!-- <div class="col-md-3"> -->
                <img class="img-responsive" src="{!! $idea->img_url !!}" style="max-height: 250px;"></img>
            <!-- </div> -->
            <!-- <div class="col-md-9"> -->
            </div>
            <div style="float: left; max-width: 60%;">
        @else
            <div style="float: left; max-width: 100%;">
        @endif
            <h2 class="no-marg-top">
            Idea<!-- 
            -->@if ($idea->name)<!-- 
                 -->: {!! $idea->name !!}
            @endif
            <!-- <button class="btn btn-default pull-right">Switch idea</button> -->
            </h2>
            <p style="font-size: 120%;">{!! $idea->text !!}</p>
        </div>
    </div>
</div> <!-- .row -->