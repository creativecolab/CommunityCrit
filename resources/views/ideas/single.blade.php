@extends('layouts.app')

@section('title', 'Idea #' . $idea->id)

@section('content')

    <div class="page-header">
        <h1>{{ $idea->name }}</h1>
        <h4>{{ $idea->text }}</h4>
    </div>

    <h2>References</h2>
    @if (!count($links))
        <p>There are no references at this time, but you can <a>add one</a>.</p>
    @endif

    <div class="row">
        @foreach ($links as $link)
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
                            {{ $link->user->fname }}, {{ $link->created_at }}
                        </div>
                    @endif
                </div> <!-- .panel -->
            </div> <!-- .col -->
        @endforeach
    </div> <!-- .row -->

    <h2>Improvements</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <ul class="list-group">
                    <li class="list-group-item">
                        This idea could be improved by xyz.
                    </li>
                    <li class="list-group-item">
                        Reference: Design Guideline
                    </li>
                </ul>
                <div class="panel-footer">
                    Courtney, 3 days ago
                </div>
            </div> <!-- .panel -->
        </div> <!-- .col -->

        <div class="col-md-4">
            <div class="panel panel-default">
                <ul class="list-group">
                    <li class="list-group-item">
                        This idea could be improved by xyz.
                    </li>
                </ul>
                <div class="panel-footer">
                    Rob, 5 days ago
                </div>
            </div> <!-- .panel -->
        </div> <!-- .col -->
    </div>

    <h2>Critique and Assessment</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <ul class="list-group">
                    <li class="list-group-item">
                        This idea doesn't xyz.
                    </li>
                    <li class="list-group-item">
                        Reference: Design Guideline
                    </li>
                </ul>
                <div class="panel-footer">
                    Courtney, 3 days ago
                </div>
            </div> <!-- .panel -->
        </div> <!-- .col -->

        <div class="col-md-4">
            <div class="panel panel-default">
                <ul class="list-group">
                    <li class="list-group-item">
                        This idea doesn't xyz.
                    </li>
                </ul>
                <div class="panel-footer">
                    Rob, 5 days ago
                </div>
            </div> <!-- .panel -->
        </div> <!-- .col -->
    </div>

    {{--@component('tasks.commentsPage', [ 'task' => $source ])--}}
    {{--@endcomponent--}}
@endsection
