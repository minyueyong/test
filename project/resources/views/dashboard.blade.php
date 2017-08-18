<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>

@if (Auth::user()->role === 1)
	<div class = "container table-responsive">
		<table>
			<tr>
				<td rowspan="2">
					<img src = "{!!$results[0]->image!!}" alt="profilepic" class="img-circle img-responsive"/>
				</td>
				<td>
					<h3 style="font-weight: bold">{!!$results[0]->firstName!!} {!!$results[0]->lastName!!}</h3>
				</td>
			</tr>

			<tr>
				<td>
					<h4 style="font-weight:bold">Member since {!!Auth::user()->created_at!!}</h4>
				</td>
			</tr>
		</table>

		<div class = "page-header">
			<h3 class="text-uppercase" style="font-weight:bold">Community Stats</h3>
		</div>
		<div style="font-size:18px">
			<div>Campus: {!!$results[0]->campus!!} University </div>
			<div>Education: Bachelor of {!!$results[0]->education!!} </div>
			<div>Area of Interest: {!!$results[0]->interest!!} </div>
			<div>Birthday: {!!$results[0]->dob!!} </div>
			<div>Gender: {!!$results[0]->gender!!} </div>
		</div>
		
		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Contact Information</h3>
		</div>
		<div style="font-size:18px">
			<div>Email: {!!$results[0]->email!!} </div>
			<div>Phone: +60{!!$results[0]->phone!!} </div>
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">About Me</h3>
		</div>
		<div style="font-size:18px">
			<div> @php echo nl2br($results[0]->aboutme); @endphp </div>
		</div>
	</div>

@elseif (Auth::user()->role === 2)
	<div class = "container table-responsive">
		<table>
			<tr>
				<td rowspan="2">
					<img src = "{!!$results[0]->image!!}" alt="profilepic" class="img-circle img-responsive"/>
				</td>
				<td>
					<h3 style="font-weight: bold">{!!$results[0]->companyName!!}</h3>
				</td>
			</tr>

			<tr>
				<td>
					<h4 style="font-weight:bold">Member since {!!Auth::user()->created_at!!}</h4>
				</td>
			</tr>
		</table>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Contact Information</h3>
		</div>
		<div style="font-size:18px">
			<div>Email: {!!$results[0]->email!!} </div>
			<div>Phone: +60{!!$results[0]->phone!!} </div>
			<div>Area of Interest: {!!$results[0]->interest!!} </div>
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">About Company</h3>
		</div>
		<div style="font-size:18px">
			<div> @php echo nl2br($results[0]->aboutcompany); @endphp </div>
		</div>

		
	</div>
@endif
@include('footer')
@stop