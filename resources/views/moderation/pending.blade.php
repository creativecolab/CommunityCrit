@extends('layouts.app')

@section('title', 'Pending')

@section('content')
	<h1>Pending Items</h1>

	<h2>Ideas</h2>
	{!! Form::open(['action' => ['ModerationController@savePendingIdeas'], 'style' => 'display:inline']) !!}
	{{ Form::hidden('ideaCount', count($ideas)) }}

	<table class="table table-hover">
		<tr>
		    <th>Name</th>
		    <th>Text</th> 
		    <th>Image URL</th>
		    <th>Actions</th>
		</tr>
		@if (count($ideas))
			@foreach($ideas as $idea)
				<tr>
				    <td style="max-width: 200px;">{{ $idea->name }}</td>
				    <td style="max-width: 600px;">{{ $idea->text }}</td> 
				    <td><img src="{{ $idea->img_url }}" style="max-height: 150px; max-width: 150px;"></td>
				    <td style="padding-left: 15px;">
				    	@foreach($actions as $key=>$action)
						    <div class="form-group{{ $errors->has($action) ? ' has-error' : '' }}">
						        {{--Radio for each item--}}
						        <div class="radio-inline">
						            <label>
						                {!! Form::radio('idea'.$idea->id, $key) !!}
						                {{$action}}
						            </label>
						        </div>
						    </div>
						@endforeach
				    </td>
				</tr>
			@endforeach
			</table>

			<div class="row">
				{!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
				{!! Form::close() !!}
			</div>
		@else
			</table>
			<h4 class="text-center">
				No pending ideas.
			</h4>
		@endif

	<h2>Links</h2>
	{!! Form::open(['action' => ['ModerationController@savePendingLinks'], 'style' => 'display:inline']) !!}
	{{ Form::hidden('linkCount', count($links)) }}
	<table class="table table-hover">
		<tr>
		    <th>Text</th> 
		    <th>Text2</th>
		    <th>Actions</th>
		</tr>
		@if (count($links))
			@foreach($links as $link)
				<tr>
				    <td>{!! $link->text !!}</td>
				    <td>{{ $link->text2 }}</td> 
				    <td style="padding-left: 15px;">
				    	@foreach($actions as $key=>$action)
						    <div class="form-group{{ $errors->has($action) ? ' has-error' : '' }}">
						        {{--Radio for each item--}}
						        <div class="radio-inline">
						            <label>
						                {!! Form::radio('link'.$link->id, $key) !!}
						                {{$action}}
						            </label>
						        </div>
						    </div>
						@endforeach
				    </td>
				</tr>
			@endforeach
			</table>

			<div class="row">
				{!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
				{!! Form::close() !!}
			</div>
		@else
			</table>
			<h4 class="text-center">
				No pending ideas.
			</h4>
		@endif

@endsection
