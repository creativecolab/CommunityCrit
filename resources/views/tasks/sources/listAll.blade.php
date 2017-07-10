@extends('layouts.app')

@section('title', $title)

@section('content')
    @foreach ($sources as $source)
        <div class="col-sm-6 col-md-4">
            <a class="panel-link" href="{{ action('TaskController@singleSource', $source->slug) }}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">{{ $source->name }}<span class="viewComments pull-right"><span class="glyphicon glyphicon-comment" data-state="off" aria-hidden="true"></span><span class="commentCount">17</span></span></div>
                    </div> <!-- .panel-heading -->
                    <div class="panel-body">
                        <p>The three men at her mast-head wore long streamers of narrow red bunting at their hats; from the stern, a whale-boat was suspended, bottom down; and hanging captive from the bowsprit was seen the long lower jaw of the last whale they had slain. Signals, ensigns, and jacks of all colours were flying from her rigging, on every side.</p>
                    </div> <!-- .panel-body -->
                </div> <!-- .panel -->
            </a>
        </div> <!-- .col -->
    @endforeach

@endsection
