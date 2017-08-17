@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')
<section id="idea-detail">
    <h1>{{ $idea->name }}</h1>
    <h4>{{ $idea->text }}</h4>

    @component('ideas.common.comment', ['idea' => $idea])
    @endcomponent

    <h2>Improvements, Critiques, and Assessments <span class="badge">{{count($feedbacks)}}</span></h2>
    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
        <div class="grid-sizer"></div>
        @foreach ($feedbacks as $feedback)
            <div class="grid-item{{ strlen($feedback->comment) > 100 ? ' width2' : '' }}">
            <!-- <div class="grid-item{{ strlen($feedback->link ? $feedback->link->text : '' . $feedback->comment) > 200 ? ' width2' : '' }}"> -->
                    <div class="panel panel-default">
                        <ul class="list-group">
                            <!-- @if ($feedback->task) -->
                                <!-- <li class="list-group-item"> -->
                                    <!-- <strong>{{$feedback->task->name}}</strong></br> -->
                                    <!-- {{--!! $feedback->task->text !!--}} -->
                                <!-- </li> -->
                            <!-- @endif -->
                            <!-- @if ($feedback->link)
                                <li class="list-group-item">
                                    <strong>Reference: 
                                        @component('utilities.link_type_name', ['link_type' => $feedback->link->link_type])
                                        @endcomponent
                                    </strong><br>
                                    {!! $feedback->link->text !!}
                                </li>
                            @endif -->
                            <li class="list-group-item comments">
                                <span class="text">{!! $feedback->comment !!}</span><br>
                                <em>
                                    {{ $feedback->user->fname }}, {!! dateForHumans($feedback->created_at) !!}
                                </em>
                            </li>
                        </ul>
                    </div> <!-- .panel -->
            </div> <!-- .grid-item -->
        @endforeach
    </div> <!-- .grid -->

    <h2>References <span class="badge">{{count($links)}}</span></h2>
    @if (!count($links))
        <p>There are no references at this time, but you can <a>add one</a>.</p>
    @endif

    <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
        <div class="grid-sizer"></div>
        @foreach ($links as $link)
            <div class="grid-item{{ strlen($link->text) > 200 ? ' width2' : '' }}">
                    <div class="panel panel-default">
                        <ul class="list-group">
                            <li class="list-group-item comments">
                                {{ $link->type_str }}<br>
                                <span class="text">{!! $link->text !!}</span><br>
                                <em>
                                    {{ $link->user->fname }}, {{ dateForHumans($link->created_at) }}
                                </em>
                            </li>
                        </ul>
                    </div> <!-- .panel -->
            </div> <!-- .grid-item -->
        @endforeach
    </div> <!-- .grid -->

</section>
@endsection