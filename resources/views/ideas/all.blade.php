@extends('layouts.app')

@section('title', 'Ideas')

@section('content')
<div id="idea-list">
    <h1>Ideas</h1>
    <p class="intro">
        Take a look at the contributions your fellow community members have made.
    </p>

    @foreach ($ideas as $idea)
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
                            {{ substr($idea->text, 0, 200) }}
                            @if(strlen($idea->text) > 200)[...]
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
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ count($idea->taskHist->where('action', 1)->whereNotIn('user_id', [1, 2, 3])->groupBy('user_id')) }}
                    <span class="glyphicon glyphicon-comment buffer-left" aria-hidden="true"></span> {{ count($idea->taskHist->where('action', 1)->whereNotIn('user_id', [1, 2, 3])) }}
                </div>
                <a href="{{ action( 'TaskController@showRandomTask', $idea->id) }}" class="btn btn-primary do">
                    Do An Activity
                </a>
                <div class="clearfix"></div>
            </li>
        </ul>
    @endforeach
</div>
@endsection