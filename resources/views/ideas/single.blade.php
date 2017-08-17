@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')
<section id="idea-detail">
    <h1>{{ $idea->name }}</h1>
    <h4>{{ $idea->text }}</h4>

    @component('ideas.common.comment', ['idea' => $idea])
    @endcomponent

    <h2>Improvements, Critiques, and Assessments <span class="badge">{{count($feedbacks)}}</span></h2>
    <!-- <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": "160" }'> -->
    <div class="row">
        <div class="col-md-12">
            <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": "true"}'>
            <!-- <div class="grid row" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".col-md-4", "percentPosition": "true" }'> -->
                <div class="grid-sizer"></div>
                @foreach ($feedbacks as $feedback)
                    <div class="grid-item{{ strlen($feedback->link ? $feedback->link->text : '' . $feedback->comment) > 200 ? ' width2' : '' }}">
                    <!-- <div class="col-md-12"> -->
                        <!-- <a class="panel-link" href="{{ action( 'IdeaController@show', $feedback->id) }}"> -->
                            <div class="panel panel-default">
                                <ul class="list-group">
                                    <!-- @if ($feedback->task) -->
                                        <!-- <li class="list-group-item"> -->
                                            <!-- <strong>{{$feedback->task->name}}</strong></br> -->
                                            <!-- {{--!! $feedback->task->text !!--}} -->
                                        <!-- </li> -->
                                    <!-- @endif -->
                                    @if ($feedback->link)
                                        <li class="list-group-item">
                                            <strong>Reference: 
                                                @component('utilities.link_type_name', ['link_type' => $feedback->link->link_type])
                                                @endcomponent
                                            </strong><br>
                                            {!! $feedback->link->text !!}
                                        </li>
                                    @endif
                                    <li class="list-group-item comments">
                                        <span class="text">{!! $feedback->comment !!}</span><br>
                                        <em>
                                            {{ $feedback->user->fname }}, {!! dateForHumans($feedback->created_at) !!}
                                        </em>
                                    </li>
                                </ul>
                                <!-- <div class="panel-footer"> -->
                                    
                                <!-- </div> -->
                            </div> <!-- .panel -->
                        <!-- </a> -->
                    </div> <!-- .grid-item -->
                @endforeach
            </div> <!-- .grid -->
        </div>
    </div>

    <h2>References <span class="badge">{{count($links)}}</span></h2>
    @if (!count($links))
        <p>There are no references at this time, but you can <a>add one</a>.</p>
    @endif

    <div class="row">
        @foreach ($links as $link)
            <!-- <div class="col-md-12"> -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @component('utilities.link_type_name', ['link_type' => $link->link_type])
                        @endcomponent
                    </div>
                    <div class="panel-body">
                        
                        {!! $link->text !!}
                    </div>
                    @if ($link->link_type >= 3)
                        <div class="panel-footer">
                            {{ $link->user->fname }}, {{ dateForHumans($link->created_at) }}
                        </div>
                    @endif
                </div> <!-- .panel -->
            </div> <!-- .col -->
        @endforeach
    </div> <!-- .row -->
    <div class="clearfix"></div>

    {{--@component('tasks.commentsPage', [ 'task' => $source ])--}}
    {{--@endcomponent--}}
</section>
@endsection