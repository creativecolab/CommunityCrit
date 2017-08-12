@extends('layouts.app')

@section('title', 'User Summary')

@section('structured-content')
<div class="container-fluid admin">
	<h1>User Summary</h1>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<col>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<tr>
			<th colspan="4" scope="colgroup">User</th>
			<th colspan="4" scope="colgroup">Ideas</th>
			<th colspan="4" scope="colgroup">Links</th>
			<th colspan="4" scope="colgroup">Feedbacks</th>
			<th colspan="4" scope="colgroup">Ratings</th>
			<th colspan="4" scope="colgroup">Total</th>
		</tr>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Initials</th>
			<th scope="col">Date Created</th>
			<th scope="col">Last Visit</th>
			<th scope="col">Submitted</th>
			<th scope="col">Skipped</th>
			<th scope="col">Exited</th>
			<th scope="col">Bounced</th>
			<th scope="col">Submitted</th>
			<th scope="col">Skipped</th>
			<th scope="col">Exited</th>
			<th scope="col">Bounced</th>
			<th scope="col">Submitted</th>
			<th scope="col">Skipped</th>
			<th scope="col">Exited</th>
			<th scope="col">Bounced</th>
			<th scope="col">Submitted</th>
			<th scope="col">Skipped</th>
			<th scope="col">Exited</th>
			<th scope="col">Bounced</th>
			<th scope="col">Submitted</th>
			<th scope="col">Skipped</th>
			<th scope="col">Exited</th>
			<th scope="col">Bounced</th>
		</tr>
		<tr class="info">
			<th scope="row">Total (#)</th>
			<td></td>
			<td></td>
			<td></td>
			<td>{{ $totalNum->get('ideas-submitted') }}</td>
			<td>{{ $totalNum->get('ideas-skipped') }}</td>
			<td>{{ $totalNum->get('ideas-exited') }}</td>
			<td>{{ $totalNum->get('ideas-bounced') }}</td>
			<td>{{ $totalNum->get('links-submitted') }}</td>
			<td>{{ $totalNum->get('links-skipped') }}</td>
			<td>{{ $totalNum->get('links-exited') }}</td>
			<td>{{ $totalNum->get('links-bounced') }}</td>
			<td>{{ $totalNum->get('feedbacks-submitted') }}</td>
			<td>{{ $totalNum->get('feedbacks-skipped') }}</td>
			<td>{{ $totalNum->get('feedbacks-exited') }}</td>
			<td>{{ $totalNum->get('feedbacks-bounced') }}</td>
			<td>{{ $totalNum->get('ratings-submitted') }}</td>
			<td>{{ $totalNum->get('ratings-skipped') }}</td>
			<td>{{ $totalNum->get('ratings-exited') }}</td>
			<td>{{ $totalNum->get('ratings-bounced') }}</td>
			<td>{{ $totalNum->get('total-submitted') }}</td>
			<td>{{ $totalNum->get('total-skipped') }}</td>
			<td>{{ $totalNum->get('total-exited') }}</td>
			<td>{{ $totalNum->get('total-bounced') }}</td>
		</tr>
		<tr class="info">
			<th scope="row">Total (%)</th>
			<td></td>
			<td></td>
			<td></td>
			<td>{{ $totalPer->get('ideas-submitted') }}</td>
			<td>{{ $totalPer->get('ideas-skipped') }}</td>
			<td>{{ $totalPer->get('ideas-exited') }}</td>
			<td>{{ $totalPer->get('ideas-bounced') }}</td>
			<td>{{ $totalPer->get('links-submitted') }}</td>
			<td>{{ $totalPer->get('links-skipped') }}</td>
			<td>{{ $totalPer->get('links-exited') }}</td>
			<td>{{ $totalPer->get('links-bounced') }}</td>
			<td>{{ $totalPer->get('feedbacks-submitted') }}</td>
			<td>{{ $totalPer->get('feedbacks-skipped') }}</td>
			<td>{{ $totalPer->get('feedbacks-exited') }}</td>
			<td>{{ $totalPer->get('feedbacks-bounced') }}</td>
			<td>{{ $totalPer->get('ratings-submitted') }}</td>
			<td>{{ $totalPer->get('ratings-skipped') }}</td>
			<td>{{ $totalPer->get('ratings-exited') }}</td>
			<td>{{ $totalPer->get('ratings-bounced') }}</td>
			<td>{{ $totalPer->get('total-submitted') }}</td>
			<td>{{ $totalPer->get('total-skipped') }}</td>
			<td>{{ $totalPer->get('total-exited') }}</td>
			<td>{{ $totalPer->get('total-bounced') }}</td>
		</tr>
		@foreach($rows as $row)
			<tr>
				<th scope="row">{{ $row->get('user_id') }}</th>
				<td>{{ $row->get('user_initials') }}</td>
				<td>{{ $row->get('created_at') }}</td>
				<td>{{ $row->get('last_visited') }}</td>
				<td>{{ $row->get('ideas-submitted') }}</td>
				<td>{{ $row->get('ideas-skipped') }}</td>
				<td>{{ $row->get('ideas-exited') }}</td>
				<td>{{ $row->get('ideas-bounced') }}</td>
				<td>{{ $row->get('links-submitted') }}</td>
				<td>{{ $row->get('links-skipped') }}</td>
				<td>{{ $row->get('links-exited') }}</td>
				<td>{{ $row->get('links-bounced') }}</td>
				<td>{{ $row->get('feedbacks-submitted') }}</td>
				<td>{{ $row->get('feedbacks-skipped') }}</td>
				<td>{{ $row->get('feedbacks-exited') }}</td>
				<td>{{ $row->get('feedbacks-bounced') }}</td>
				<td>{{ $row->get('ratings-submitted') }}</td>
				<td>{{ $row->get('ratings-skipped') }}</td>
				<td>{{ $row->get('ratings-exited') }}</td>
				<td>{{ $row->get('ratings-bounced') }}</td>
				<td>{{ $row->get('total-submitted') }}</td>
				<td>{{ $row->get('total-skipped') }}</td>
				<td>{{ $row->get('total-exited') }}</td>
				<td>{{ $row->get('total-bounced') }}</td>
			</tr>
		@endforeach
	</table>
</div>
@endsection