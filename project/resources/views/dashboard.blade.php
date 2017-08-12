<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>

<div class = "container table-responsive">
	<table>
		<tr>
			<td rowspan="2">
				<img src = "{!!Auth::user()->image!!}" alt="profilepic" class="img-circle img-responsive"/>
			</td>
			<td>
				<h3 style="font-weight: bold">{!!Auth::user()->firstName!!} {!!Auth::user()->lastName!!}</h3>
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
		<div>Campus: {!!Auth::user()->campus!!} University </div>
		<div>Education: Bachelor of {!!Auth::user()->education!!} </div>
		<div>Area of Interest: {!!Auth::user()->interest!!} </div>
		<div>Birthday: {!!Auth::user()->dob!!} </div>
		<div>Gender: {!!Auth::user()->gender!!} </div>
	</div>
	
	<div class = "page-header">
		<h3 class ="text-uppercase" style="font-weight:bold">Contact Information</h3>
	</div>
	<div style="font-size:18px">
		<div>Email: {!!Auth::user()->email!!} </div>
		<div>Phone: +60{!!Auth::user()->phone!!} </div>
	</div>

	<div class = "page-header">
		<h3 class ="text-uppercase" style="font-weight:bold">About Me</h3>
	</div>
	<div style="font-size:18px">
		<div> @php echo nl2br(Auth::user()->aboutme); @endphp </div>
	</div>
</div>
@include('footer')
@stop