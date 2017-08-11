@extends('layouts.app')

@section('title', 'User Summary')

@section('structured-content')
<div class="container-fluid">
	<h1>User Summary</h1>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<col>
		<colgroup span="3"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<colgroup span="4"></colgroup>
		<tr>
			<td rowspan="2"></td>
			<th colspan="2" scope="colgroup">User</th>
			<th colspan="4" scope="colgroup">Ideas</th>
			<th colspan="4" scope="colgroup">Links</th>
			<th colspan="4" scope="colgroup">Feedbacks</th>
			<th colspan="4" scope="colgroup">Total</th>
		</tr>
		<tr>
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
		</tr>
		<tr class="info">
			<th scope="row">Total (#)</th>
			<th></th>
			<th></th>
			<th>12</th>
			<th>234</th>
			<th>12</th>
			<th>3245</th>
			<th>3456</th>
			<th>2345</th>
			<th>2345</th>
			<th>3456</th>
			<th>567</th>
			<th>3456</th>
			<th>2345</th>
			<th>3456</th>
			<th>2354</th>
			<th>3456</th>
			<th>2345</th>
			<th>3456</th>
		</tr>
		<tr class="info">
			<th scope="row">Total (%)</th>
			<th></th>
			<th></th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
			<th>35%</th>
		</tr>
		<tr>
			<th scope="row">user_id</th>
			<td>08/12/17</td>
			<td>08/13/17</td>
			<td>12</td>
			<td>234</td>
			<td>12</td>
			<td>3245</td>
			<td>3456</td>
			<td>2345</td>
			<td>2345</td>
			<td>3456</td>
			<td>567</td>
			<td>3456</td>
			<td>2345</td>
			<td>3456</td>
			<td>2354</td>
			<td>3456</td>
			<td>2345</td>
			<td>3456</td>
		</tr>
		<!-- <tr>
			<th scope="row">user_id</th>
			<td>date_created</td>
			<td>last_visited</td>
			<td>ideas-submitted</td>
			<td>ideas-skipped</td>
			<td>ideas-exicted</td>
			<td>ideas-bounced</td>
			<td>links-submitted</td>
			<td>links-skipped</td>
			<td>links-exicted</td>
			<td>links-bounced</td>
			<td>feedbacks-submitted</td>
			<td>feedbacks-skipped</td>
			<td>feedbacks-exicted</td>
			<td>feedbacks-bounced</td>
			<td>total-submitted</td>
			<td>total-skipped</td>
			<td>total-exicted</td>
			<td>total-bounced</td>
		</tr> -->
	</table>
</div>
@endsection