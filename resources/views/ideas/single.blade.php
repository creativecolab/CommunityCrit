@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')
<section id="idea-detail" class="masonry">
    <h1>{{ $idea->name }}</h1>
    <h4>{{ $idea->text }}</h4>

    <!-- <h2>Responses <span class="badge">{{count($comments)}}</span></h2> -->
    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
        <div class="grid-sizer"></div>
        <div class="grid-item width2">
            @component('ideas.common.comment', ['idea' => $idea])
            @endcomponent
        </div>
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
                        @if ($comment->task->type == 61)
                            {{ $questions->where('id',$comment->ques_id)->first()->text }}
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

</section>
@endsection