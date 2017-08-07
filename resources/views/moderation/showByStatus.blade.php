@extends('layouts.app')

@section('title', 'Pending')

@section('content')
	<h1>{{ $status }} Items</h1>

	<h2>Ideas</h2>
	<table class="table table-hover">
		<tr>
		    <th>Name</th>
		    <th>Text</th> 
		    <th>Image URL</th>
		</tr>
	@if (count($ideas))
		@foreach($ideas as $idea)
			<tr>
			    <td style="max-width: 200px;">{{ $idea->name }}</td>
			    <td>{{ $idea->text }}</td> 
			    <td><img src="{{ $idea->img_url }}" style="max-height: 150px; max-width: 150px;"></td>
			</tr>
		@endforeach
		</table>
	@else
		</table>
		<h4 class="text-center">
			No {{ strtolower($status) }} ideas.
		</h4>
	@endif

	<h2>Links</h2>
	<table class="table table-hover">
		<tr>
		    <th>Text</th>
		    <th>Text 2</th> 
		</tr>
	@if (count($links))
		@foreach($links as $link)
			<tr>
			    <td>{!! $link->text !!}</td>
			    <td>{{ $link->text2 }}</td> 
			</tr>
		@endforeach
		</table>
	@else
		</table>
		<h4 class="text-center">
			No {{ strtolower($status) }} links.
		</h4>
	@endif

	<h2>Feedbacks</h2>
	<table class="table table-hover">
		<tr>
		    <th>Comment</th>
		</tr>
	@if (count($feedbacks))
		@foreach($feedbacks as $feedback)
			<tr>
			    <td>{{ $feedback->comment }}</td>
			</tr>
		@endforeach
		</table>
	@else
		</table>
		<h4 class="text-center">
			No {{ strtolower($status) }} feedbacks.
		</h4>
	@endif

@endsection
