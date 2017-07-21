@extends('layouts.app')

@section('title', 'Image Test')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {!! $name !!}
                    </div>

                    <div class="panel-body">
                        {!! $text !!}

                        {{--@if( isset($subtasks) )--}}
                        {{--@foreach ($subtasks as $subtask)--}}
                        {{--<strong>{{ $subtask->name }}@if(isset($recommendations) && $recommendations->contains($subtask->id))--}}
                        {{--<span class="label label-primary">Recommended for You</span>@endif</strong>--}}
                        {{--<p>{!! html_entity_decode($subtask->text) !!}</p>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                    </div>

                    <div class="panel-footer">
                        {!! Form::open(['action' => ['TaskController@uploadImage'], 'files' => 'true']) !!}
                        {!! Form::file('photo', ['text-align' => 'left', 'style' => 'display:inline']) !!}
                        {!! Form::submit('Submit', ['text-align' => 'right', 'style' => 'display:inline']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

