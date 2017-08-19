@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    <div id="main-menu">
        <h1>Do An Activity</h1>
        <p>Please select an option below to begin contributing.</p>

        @if(!$comp_ideas->isEmpty())
        <section>
            <h3>Ideas You Have Worked On</h3>
            <div class="row">
                    @foreach ($comp_ideas as $key=>$idea)
                        <div class="col-sm-6 col-md-4">
                            <a id="idea-link-{{$key}}" class="panel-link" href="{{ action( 'TaskController@showRandomTask', $idea->id) }}">
                                <div class="panel panel-default">
                                    <div id="idea-name-{{$key}}" class="panel-body lg">
                                        @if ($idea->name)
                                            {{$idea->name}} <span class="glyphicon glyphicon-ok pull-right" style="color:green"></span>
                                        @endif
                                    </div>
                                </div> <!-- .panel -->
                            </a>
                        </div> <!-- .col -->
                    @endforeach
            </div>
        </section>
        @endif

        <section>
        <div class="row">
            <div class="col-md-9">
                <h2 style="display:inline">Pick an Idea to Work On</h2>
                {{--<a id="refresher"><span class="glyphicon glyphicon-refresh"></span></a>--}}
                @if(!$ideas->isEmpty())
                <p>Here are three random ideas that were submitted by community members. Select one to complete five activities related to that idea. You are always free to skip activities, and you can switch to a different idea by coming back to this page at any time.</p>
            </div>
            <div class="col-md-3">
                <div id="listStuff" style="float: right;">
                    <ul class="pagination"></ul>
                </div>
            </div>
        </div>
        <div id="shown-ideas" class="row" style="min-height: 158px;">
            <div id="pageStuff">
            @foreach ($ideas as $key=>$idea)
                <div class="col-sm-6 col-md-4">
                    <a id="idea-link-{{$key}}" class="panel-link" href="{{ action( 'TaskController@showRandomTask', $idea->id) }}">
                        <div class="panel panel-default">
                            <div id="idea-name-{{$key}}" class="panel-body lg">
                                @if ($idea->name)
                                    {{$idea->name}}
                                @endif
                            </div>
                        </div> <!-- .panel -->
                    </a>
                </div> <!-- .col -->
            @endforeach
            </div>
        </div>

        @endif
        <div>
            {{--@foreach ($comp_ideas as $key=>$idea)--}}
                {{--<div class="col-sm-6 col-md-4">--}}
                    {{--<a id="idea-link-{{$key}}" class="panel-link" href="{{ action( 'TaskController@showRandomTask', $idea->id) }}">--}}
                        {{--<div class="panel panel-default">--}}
                            {{--<div id="idea-name-{{$key}}" class="panel-body lg">--}}
                                {{--@if ($idea->name)--}}
                                    {{--{{$idea->name}}--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div> <!-- .panel -->--}}
                    {{--</a>--}}
                {{--</div> <!-- .col -->--}}
            {{--@endforeach--}}
        </div>
        <section>

        <section>
            <div class="row">
                <div class="col-md-6">
                    <h2>Have an idea?</h2>
                    <p>Add your own idea for the future of El Nudillo.</p>
                    <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
                        Submit a New Idea
                    </a>
                </div>
                <div class="col-md-6">
                    <h2>All done?</h2>
                    <p>Please take this short survey so we can improve the experience of CommunityCrit for other community members. You will receive a $5 Amazon gift card after you complete the survey for the first time.</p>
                    @if (auth()->user()->submitted < 1)
                        <a class="btn btn-primary disabled" data-toggle="tooltip" data-placement="bottom" title="You must complete one activity before taking the exit survey.">Go to Exit Survey</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('exit') }}">Go to Exit Survey</a>
                    @endif
                </div>
            </div>
        </section>

    </div>
@endsection

@section('custom-script')
<script>
    @if (auth()->user()->submitted < 1)
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    @endif

    var refresher = document.getElementById('refresher');
    if (refresher)
        refresher.onclick = refresherHandler;

    //pages
    var listElement = $('#pageStuff');
    var perPage = 3;
    var numItems = listElement.children().length;
    var numPages = Math.ceil(numItems/perPage);

    $('.pagination').data("curr",0);

    var curr = 0;
    while(numPages > curr){
        if (curr == 0) {
            $('<li class="active"><a class="page_link">' + (curr + 1) + '</a></li>').appendTo('.pagination');
        }
        else {
            $('<li><a class="page_link">' + (curr + 1) + '</a></li>').appendTo('.pagination');
        }
        curr++;
    }

    $('.pagination .page_link:first').addClass('active');

    listElement.children().css('display', 'none');
    listElement.children().slice(0, perPage).css('display', 'block');

    $('.pagination li a').click(function(){
        var clickedPage = $(this).html().valueOf() - 1;

        var nodes = document.getElementById("listStuff").getElementsByTagName("li");
        for (var i = 0; i < nodes.length; i++) {
            nodes[i].setAttribute("class", "");
        }

        var node = document.getElementById("listStuff").getElementsByTagName("li")[clickedPage];
        node.setAttribute("class", "active");

        goTo(clickedPage,perPage);
    });

    function previous(){
        var goToPage = parseInt($('.pagination').data("curr")) - 1;
        if($('.active').prev('.page_link').length==true){
            goTo(goToPage);
        }
    }

    function next(){
        goToPage = parseInt($('.pagination').data("curr")) + 1;
        if($('.active_page').next('.page_link').length==true){
            goTo(goToPage);
        }
    }

    function goTo(page){
        var startAt = page * perPage,
                endOn = startAt + perPage;

        listElement.children().css('display','none').slice(startAt, endOn).css('display','block');
        $('.pagination').attr("curr",page);
    }
</script>
@endsection
