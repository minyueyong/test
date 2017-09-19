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
			<div>Status: {!!$results[0]->status!!}</div>
			<div>Experience: {!!$results[0]->experience!!}</div>
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

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Participated Activities</h3>
		</div>
		<div style="font-size:18px">
			<div>
				@php 
		  			$events = DB::table('studentsnevents')->where('studentid', $results[0]->studentid)->pluck('eventid');
				@endphp

				@foreach($events as $event)
					@php 
						$currentDate = date('Y-m-d');
        				$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
						$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
					@endphp
				<div>
					@if($eventDate < $currentDate)
						{!!$eventName!!}
					@endif
				</div>
				@endforeach
			</div>
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
			<div>Status: {!!$results[0]->status!!} </div>
			<div>Membership Expired Date: {!!$results[0]->membershipDate!!} </div>
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

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Upcoming Activites</h3>
		</div>
		<div style="font-size:18px">
			<div>
				@php 
					$userid = Auth::user()->id;
					$companyid = DB::table('companies')->where('companies.userid','=',$userid)->value('companies.companyid');
					$events = DB::table('events')->where('events.companyid','=',$companyid)->get();
				@endphp

				@foreach($events as $event)
					@php
						$date = date('Y-m-d');
					@endphp
					@if($event->eventDate > $date)
						<a id = "viewevent" href="{{ url('viewevent/'.$event->eventid) }}">{{$event->eventName}}</a><br>
					@endif
				@endforeach
			</div>
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Past Activites</h3>
		</div>
		<div style="font-size:18px">
			@php 
				$userid = Auth::user()->id;
				$companyid = DB::table('companies')->where('companies.userid','=',$userid)->value('companies.companyid');
				$events = DB::table('events')->where('events.companyid','=',$companyid)->get();
			@endphp

			@foreach($events as $event)
				@php
					$date = date('Y-m-d');
				@endphp
				@if($event->eventDate <= $date)
					<a id = "viewevent" href="{{ url('viewevent/'.$event->eventid) }}">{{$event->eventName}}</a><br>
				@endif
			@endforeach
		</div>

		<a href="{{ url('postevent') }}" class = "btn btn-default login-btn pull-right">Post an Activity</a> 
	</div>

@elseif (Auth::user()->role === 3)
	<div class = "container table-responsive">
		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Waiting for Approval Company</h3>
		</div>
	</div>
@endif
@include('footer')
@stop