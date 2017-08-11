@extends('layouts.app')

@section('title', 'Pending')

@section('content')
	<h1>{{ $status }} Items</h1>

	{!! Form::open(['action' => ['AdminController@updateIdeasStatus', $statusKey], 'style' => 'display:inline']) !!}
	{{ Form::hidden('ideaCount', count($ideas)) }}
	
	<h2>
		Ideas
		{!! Form::submit('Save Ideas', ['class' => 'btn btn-primary pull-right']) !!}
	</h2>
	
	

	<table class="table table-hover">
		<tr>
		    <th>Name</th>
		    <th>Text</th> 
		    <th>Image URL</th>
		    <th>Change Status</th>
		</tr>
		@if (count($ideas))
			@foreach($ideas as $idea)
				<tr>
				    <td style="max-width: 200px;">{{ $idea->name }}</td>
				    <td style="max-width: 600px;">{{ $idea->text }}</td> 
				    <td><img src="{{ $idea->img_url }}" style="max-height: 150px; max-width: 150px;"></td>
				    <td style="padding-left: 15px;">
				    	@foreach($actions as $key=>$action)
						    <div class="{{ $errors->has('idea'.$idea->id) ? ' has-error' : '' }}">
						        {{--Radio for each item--}}
						        <div class="radio-inline">
						            <label>
						                {!! Form::radio('idea'.$idea->id, $key) !!}
						                {{$action}}

						                {{--, ($statusKey == $key ? true : false)--}}
						            </label>
						        </div>
						    </div>
						@endforeach
				    </td>
				</tr>
			@endforeach
			</table>
			
		@else
			</table>
			<h4 class="text-center">
				No {{ strtolower($status) }} ideas.
			</h4>
		@endif
		{!! Form::close() !!}

	{!! Form::open(['action' => ['AdminController@updateLinksStatus', $statusKey], 'style' => 'display:inline']) !!}
	{{ Form::hidden('linkCount', count($links)) }}

	<h2>
		Links
		{!! Form::submit('Save Links', ['class' => 'btn btn-primary pull-right']) !!}
	</h2>
	
	<table class="table table-hover">
		<tr>
		    <th>Text</th> 
		    <th>Text2</th>
		    <th>Change Status</th>
		</tr>
		@if (count($links))
			@foreach($links as $link)
				<tr>
				    <td>{!! $link->text !!}</td>
				    <td>{{ $link->text2 }}</td> 
				    <td style="padding-left: 15px;">
				    	@foreach($actions as $key=>$action)
						    <div class="{{ $errors->has('link'.$link->id) ? ' has-error' : '' }}">
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

		@else
			</table>
			<h4 class="text-center">
				No {{ strtolower($status) }} links.
			</h4>
		@endif
		{!! Form::close() !!}

	{!! Form::open(['action' => ['AdminController@updateFeedbacksStatus', $statusKey], 'style' => 'display:inline']) !!}
	{{ Form::hidden('feedbackCount', count($feedbacks)) }}

	<h2>
		Feedbacks
		{!! Form::submit('Save Feedbacks', ['class' => 'btn btn-primary pull-right']) !!}
	</h2>
	
	<table class="table table-hover">
		<tr>
		    <th>Comment</th> 
		    <th>Change Status</th>
		</tr>
		@if (count($feedbacks))
			@foreach($feedbacks as $feedback)
				<tr>
				    <td>{!! $feedback->comment !!}</td>
				    <td style="padding-left: 15px;">
				    	@foreach($actions as $key=>$action)
						    <div class="{{ $errors->has('feedback'.$feedback->id) ? ' has-error' : '' }}">
						        {{--Radio for each item--}}
						        <div class="radio-inline">
						            <label>
						                {!! Form::radio('feedback'.$feedback->id, $key) !!}
						                {{$action}}
						            </label>
						        </div>
						    </div>
						@endforeach
				    </td>
				</tr>
			@endforeach
			</table>

		@else
			</table>
			<h4 class="text-center">
				No {{ strtolower($status) }} feedbacks.
			</h4>
		@endif
		{!! Form::close() !!}

@endsection
