@extends('layouts.app')

@section('title', 'Ideas')

@section('content')
<div id="idea-list" class="masonry">
    <h1>Ideas</h1>
    <p class="intro">
        Click on an idea to look at the contributions your fellow community members have made.
    </p>

    <div id="masondiv" class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": "#grid-sizer", "percentPosition": "true"}'>
        <div id="grid-sizer" class="col-md-6 col-sm-12"></div>
        @foreach ($ideas as $idea)
            <div class="grid-item col-md-6 col-sm-12">
                <ul class="list-group">
                    <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                        <li class="list-group-item{{ $idea->img_url ? ' has-img' : '' }} first" id="idea">    
                            <div id="text">
                                <h2>
                                    @if ($idea->name)
                                        {{ $idea->name }}
                                    @else
                                        Idea
                                    @endif
                                </h2>
                                <p>
                                    {{ substr($idea->text, 0, 300) }}
                                    @if(strlen($idea->text) > 300) [...]
                                    @endif
                                </p>
                            </div>
                            @if ($idea->img_url)
                                <div id="img">
                                    <img src="{{ $idea->img_url }}">
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </li>
                    </a>
                    <li class="list-group-item last">
                        <div class="pull-right">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ count($idea->contributions->groupBy('user_id')) }}
                            <span class="glyphicon glyphicon-comment buffer-left" aria-hidden="true"></span> {{ count($idea->contributions)-$idea->num_questions }}
                        </div>
                        <a href="{{ action( 'TaskController@showRandomTask', $idea->id) }}" class="btn btn-primary do">
                            Do An Activity For This Idea
                        </a>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>
        @endforeach
    </div> <!-- .grid -->
</div>
@endsection