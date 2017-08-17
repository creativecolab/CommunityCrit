@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')
<section id="idea-detail" class="masonry">
    <div id="idea" class="{{ $idea->img_url ? 'has-img' : '' }}">
        <div id="text">
            <h1>{{ $idea->name }}</h1>
            <h4>{{ $idea->text }}</h4>
        </div>
        @if ($idea->img_url)
            <div id="img">
                <img src="{{ $idea->img_url }}">
            </div>
            <div class="clearfix"></div>
        @endif
    </div>

    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
        <div class="grid-sizer"></div>
        <div class="grid-item width2">
            @component('ideas.common.comment', ['idea' => $idea])
            @endcomponent
        </div>
    </div>
        @foreach ($commentsByTask as $comments)
            <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
            <div class="grid-sizer"></div>
            @if ($comments->first()->task)
                <div class="grid-item{{ strlen($comments->first()->task->type == 61 ? $questions->where('id',$comments->first()->ques_id)->first()->text : $comments->first()->task->name) > 100 ? ' ' : ' ' }}">
                    <ul class="list-group">
                        <li class="list-group-item dark">
                            @if ($comments->first()->task->type == 61)
                                {{ $questions->where('id',$comments->first()->ques_id)->first()->text }}
                                {{-- $comments->first()->question->text --}}
                            @else
                                <strong>{{ $comments->first()->task->name }}:</strong>
                                {{ $comments->first()->task->text }}
                            @endif
                        </li>
                    </ul>
                </div> <!-- .grid-item -->
            @endif
            @foreach ($comments as $comment)
                <div class="grid-item{{ strlen($comment->comment ? $comment->comment : $comment->text) > 100 ? ' width2' : '' }}">
                    <ul class="list-group">
                    @if ($comment->comment)
                        {{--<!-- @if ($comment->link)
                            <li class="list-group-item">
                                <strong>
                                    Submission: {{ $comment->link->type_str}}
                                </strong><br>
                                {!! $comment->link->text !!}
                            </li>
                        @endif -->--}}
                        <li class="list-group-item comments">
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
    

</section>
@endsection