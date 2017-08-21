@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
<div class="masonry" id="feedback">
    {{--<div class="row">--}}
    <h1>
        <span>My Contributions</span>
        <a class="btn btn-primary do" href="{{ route( 'main-menu') }}">
            Do More Activities
        </a>
    </h1>
    <br>
    {{--</div>--}}
    <h2>
        My Ideas
        <span class="badge">{{count($ideas)}}</span>
        <a class="btn btn-primary do" href="{{ route( 'submit-idea') }}">
            Submit a New Idea
        </a>
    </h2>
    @if (!count($ideas))
        <h4>You have not submitted any ideas yet.</h4>
        <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
            Submit a New Idea
        </a>
    @endif

    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": "#grid-sizer", "percentPosition": "true"}'>
        <div id="grid-sizer" class="col-md-4 col-sm-6"></div>
        @foreach ($ideas as $idea)
            <div class="grid-item col-md-4 col-sm-6">
                {{--@if ($idea->status == 1)--}}
                    <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                {{--@endif--}}
                    <ul class="list-group">
                        <li class="list-group-item comments">
                            <h4>{{ $idea->name }}</h4>
                            <span class="text">{!! $idea->text !!}</span><br>
                            @if ($idea->img_url)
                                <div id="img">
                                    <img src="{{ $idea->img_url }}" class="img-responsive">
                                </div>
                            @endif
                            <em>
                                {!! dateForHumans($idea->created_at) !!}
                            </em>
                        </li>
                    </ul>
                {{--@if ($idea->status == 1)--}}
                    </a>
                {{--@endif--}}
            </div> <!-- .grid-item -->
        @endforeach
    </div> <!-- .grid -->

    <h2>
        My Activities
        <span class="badge">{{ auth()->user()->submitted - count($ideas) }}</span>
    </h2>{{--<span class="badge">{{count($comments)}}</span></h2>--}}
    @if (!count($commentsGroup))
        <h4>You have not submitted an activity yet.</h4>
        <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
            Do An Activity
        </a>
    @endif

    @foreach ($commentsGroup as $comments)
        @if ($comments->first()->idea->status == 1)
        <h3>
            <span>{{ $comments->first()->idea->name }}</span>
            <a href="{{ action( 'IdeaController@show', $comments->first()->idea->id) }}" class="btn btn-primary do">
                View Idea
            </a>
            <a href="{{ action( 'TaskController@showRandomTask', $comments->first()->idea->id) }}" class="btn btn-primary do">
                Do An Activity For This Idea
            </a>
        </h3>
        <p>{{ $comments->first()->idea->text }}</p>
        <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": "#grid-sizer", "percentPosition": "true"}'>
            <div id="grid-sizer" class="col-md-3 col-sm-4"></div>
            @foreach ($comments as $comment)
                <div class="grid-item{{ strlen($comment->comment ? $comment->comment : $comment->text) > 100 ? ' col-md-6 col-sm-6' : ' col-md-3 col-sm-4' }}">
                    <ul class="list-group">
                    @if ($comment->comment)
                        <li class="list-group-item comments">
                            @if ($comment->task->type == 61)
                                {{ $questions->where('id',$comment->ques_id)->first()->text }}<br>
                                {{-- $comment->question->text --}}
                            @else
                                {{ $comment->task->name }}<br>
                            @endif
                            <span class="text">{!! $comment->comment !!}</span><br>
                            <em>
                                {{ $comment->user->fname }}, {!! dateForHumans($comment->created_at) !!}
                            </em>
                        </li>
                    @else
                        <li class="list-group-item comments">
                            {{ $comment->type_str }}<br>
                            <span class="text">{!! $comment->text !!}</span><br>
                            <em>
                                {{ $comment->user->fname }}, {{ dateForHumans($comment->created_at) }}
                            </em>
                        </li>
                    @endif
                    </ul>
                </div> <!-- .grid-item -->
            @endforeach
        </div> <!-- .grid -->
        @endif
    @endforeach
</div>
@endsection