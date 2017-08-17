@extends('layouts.app')

@section('title', 'My Contributions')

@section('content')
<div class="masonry" id="feedback">
    <h1>My Contributions</h1>
    <h2>My Ideas <span class="badge">{{count($ideas)}}</span></h2>
    @if (!count($ideas))
        <h4>You have not submitted any ideas yet.</h4>
        <a class="btn btn-primary" href="{{ route( 'submit-idea') }}">
            Submit a New Idea
        </a>
    @endif

    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
        <div class="grid-sizer"></div>
        @foreach ($ideas as $idea)
            <div class="grid-item{{ strlen($idea->text) > 100 ? ' width2' : '' }}">
                @if ($idea->status == 1)
                    <a class="panel-link" href="{{ action( 'IdeaController@show', $idea->id) }}">
                @endif
                    <ul class="list-group">
                        <li class="list-group-item comments">
                            <h4>{{ $idea->name }}</h4>
                            <span class="text">{!! $idea->text !!}</span><br>
                            <em>
                                {!! dateForHumans($idea->created_at) !!}
                            </em>
                        </li>
                    </ul>
                @if ($idea->status == 1)
                    </a>
                @endif
            </div> <!-- .grid-item -->
        @endforeach
    </div> <!-- .grid -->

    <h2>My Responses {{--<span class="badge">{{count($comments)}}</span></h2>--}}
    @if (!count($commentsGroup))
        <h4>You have not submitted an activity yet.</h4>
        <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
            Do An Activity
        </a>
    @endif

    @foreach ($commentsGroup as $comments)
        <h3>{{ $comments->first()->idea->name }}</h3>
        <p>
            {{  $comments->first()->idea->text }}
            @if ($comments->first()->idea->status == 1)
                <a href="{{ action( 'IdeaController@show', $idea->id) }}">read more</a>
            @endif
        </p>
        <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
            <div class="grid-sizer"></div>
            @foreach ($comments as $comment)
                <div class="grid-item{{ strlen($comment->comment ? $comment->comment : $comment->text) > 100 ? ' width2' : '' }}">
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
    @endforeach
</div>
@endsection