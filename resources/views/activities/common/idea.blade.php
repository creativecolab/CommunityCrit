<div class="row">
    <!-- <div class="col-md-3"> -->
        <!-- <img class="img-responsive" src="/img/placeholder.jpg"></img> -->
    <!-- </div> -->
    <!-- <div class="col-md-9"> -->
    <div class="col-md-12">
        <h2 class="no-marg-top">
        Idea<!-- 
        -->@if ($idea->name)<!-- 
             -->: {!! $idea->name !!}
        @endif
        <!-- <button class="btn btn-default pull-right">Switch idea</button> -->
        </h2>
        <p>{!! $idea->text !!}</p>
    </div>
</div> <!-- .row -->