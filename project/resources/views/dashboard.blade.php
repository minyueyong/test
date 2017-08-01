<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet">

<div class = "container table-responsive">
	<table>
		<tr>
			<td rowspan="2">
				<img src = "{!!Auth::user()->image!!}" alt="profilepic" class="img-circle img-responsive"/>
			</td>
			<td>
				<h3> {!!Auth::user()->firstName!!} {!!Auth::user()->lastName!!}</h3>
			</td>
		</tr>

		<tr>
			<td>
				<h4> Member since {!!Auth::user()->created_at!!}</h4>
			</td>
		</tr>
	</table>
</div>
@include('footer')
@stop