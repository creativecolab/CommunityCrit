@extends('layouts.app')

@section('title', 'Show All')

@section('content')
<div class="admin">
	<!-- <h1>Ideas</h1>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr>
			<th>Idea</th>
			<th>Useful?</th>
			<th style="min-width: 250px;">Comments</th>
		</tr>
		
		@foreach($ideas as $idea)
			<tr>
				<td>
					<strong>{{ $idea->name }}</strong><br>
					{{ $idea->text }}
				</td>
				<td>
					<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Yes<br>
					<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span> No
				</td>
				<td></td>
			</tr>
		@endforeach
	</table> -->
		

	<h1>Submissions</h1>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr>
			<th>Link</th>
			<th>Useful?</th>
			<th style="min-width: 250px;">Comments</th>
		</tr>
		
		@foreach($ideas as $idea)
			<h3>{{ $idea->name }}</h3>
			<p><strong>{{ $idea->text }}</strong></p>
			<table class="table table-striped table-bordered table-condensed table-hover">
				<tr>
					<th>Comment</th>
					<th>Applicable?</th>
					<th>Does Comply?</th>
					<th style="min-width: 250px;">Your Thoughts</th>
				</tr>
				@if (count($idea->links))
					<div style="display: none;">{{ $linkTasks = $idea->linkTasks->where("type", "!=", "20") }}</div>
					@foreach($linkTasks as $linkTask)
					<tr>
						<th class="idea" colspan="4">
							<strong>{{ $linkTask->name . ': ' . $linkTask->text . " " . $linkTask->id}}</strong>
						</th>
					</tr>
						<div style="display: none;">{{ $links = $idea->links->where('task_id', $linkTask->id) }}</div>
						@foreach($links as $link)
							<tr>
								<td>{{ $link->text }}{{ $link->task_id }}</td>
								<td>
									<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</td>
								<td>
									<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</td>
								<td></td>
							</tr>
						@endforeach
					@endforeach
				@endif

				@if (count($idea->feedback))
					<div style="display: none;">{{ $feedbackTasks = $idea->feedbackTasks }}</div>
					@foreach($feedbackTasks as $feedbackTask)
					<tr>
						<th class="idea" colspan="4">
							<strong>{{ $feedbackTask->name . ': ' . $feedbackTask->text }}</strong>
						</th>
					</tr>
						<div style="display: none;">{{ $feedbacks = $idea->feedback->where('task_id', $feedbackTask->id) }}</div>
						@foreach($feedbacks as $feedback)
							<tr>
								<td>{{ $feedback->comment }}</td>
								<td>
									<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</td>
								<td>
									<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</td>
								<td></td>
							</tr>
						@endforeach
					@endforeach
				@endif
		@endforeach
	</table>

	<h1>Feedbacks</h1>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr>
			<th>Idea</th>
		</tr>
		
		@foreach($ideas as $idea)
			<tr>
				<td>{{ $idea->name }}</td>
			</tr>
		@endforeach
	</table>
</div>

@endsection