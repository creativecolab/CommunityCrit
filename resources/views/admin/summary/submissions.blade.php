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
		

	<h1 class="print-none">Submissions</h1>
		
	@foreach($ideas as $idea)
	<h3>{{ $idea->name }}</h3>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<tr>
				<th>Comment</th>
				<th>Applicable?</th>
				<th>Does Comply?</th>
				<th style="min-width: 250px;">Your Thoughts</th>
			</tr>
			<tr>
				<th class="idea-text">
					<strong>Submit a New Idea</strong><br>
					{{ $idea->text }}
				</th>
				<td>
					<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</td>
				<td>
					<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</td>
				<td></td>
			</tr>
			@if (count($idea->links->where('status', 1)))
				<div style="display: none;">{{ $links = $idea->links->where('status', 1)->sortBy('task_id') }}</div>
				@foreach($links as $link)
					<tr>
						<td>
							@if ($link->link_type >= 5 && $link->task)
								<strong>{{ $link->task->name }}</strong><br>
							@endif
							{!! $link->text !!}
						</td>
						<td>
							<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</td>
						<td>
							<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</td>
						<td></td>
					</tr>
				@endforeach
			@endif

			@if (count($idea->feedback->where('status', 1)))
				<div style="display: none;">{{ $feedbacks = $idea->feedback->where('status', 1)->sortBy('task_id') }}</div>
				@foreach($feedbacks as $feedback)
					<tr>
						<td>
							<strong>{{ $feedback->task->name }}</strong><br>
							{{ $feedback->comment }}
						</td>
						<td>
							<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</td>
						<td>
							<span style="border: 1px gray solid; width: 20px; height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</td>
						<td></td>
					</tr>
				@endforeach
			@endif
		</table>
	</div>
	@endforeach
</div>

@endsection