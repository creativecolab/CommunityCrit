@extends('layouts.app')

@section('title', 'Pending')

@section('content')

    {!! Form::open(['action' => ['AdminController@updateNames']]) !!}
    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Original Name</th>
            <th>Text</th>
            <th>New Name</th>
        </tr>
    @foreach($ideas as $key=>$idea)
        <tr>
            <td style="max-width: 200px;">{{ $idea->name }}</td>
            <td style="max-width: 200px;">@if(!$idea->old_name){{ $idea->name }}@else {{$idea->old_name}} @endif</td>
            <td style="max-width: 600px;">{{ substr($idea->text, 0, 200) }}@if(strlen($idea->text) > 200)[...]@endif</td>
            <td style="max-width: 600px;">
                {!! Form::text($idea->id) !!}
            </td>

        </tr>
        @endforeach
        </table>

        <div class="row">
            {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
        </div>
    {!! Form::close() !!}
@endsection