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
						$studentParticipate = DB::table('studentsnevents')->where('studentid',$results[0]->studentid)->where(DB::raw('eventid'), $event)->value('participate');
					@endphp
				<div>
					@if($eventDate < $currentDate && $studentParticipate == 1)
						 {!!$eventDate!!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!$eventName!!}
					@endif
				</div>
				@endforeach
			</div>
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Upcoming Activities</h3>
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
					@if($eventDate >= $currentDate)
						<a href="{{ url('viewevent/'.$event) }}" id="thumbnail">{!!$eventName!!}</a>
					@endif
				</div>
				@endforeach
			</div>
		</div>
	</div>

@elseif (Auth::user()->role === 2)
	<div class = "container table-responsive">
	@if ($results[0]->companyApproval === 1)
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
					@if($event->eventDate >= $date && $event->eventApproval === 1)
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
				@if($event->eventDate < $date && $event->eventApproval === 1)
					{{$event->eventDate}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$event->eventName}} <br>
				@endif
			@endforeach
		</div>

		<a href="{{ url('postevent') }}" class = "btn btn-default login-btn pull-right">Post an Activity</a>

	@else
		<h3 class ="text-uppercase" style="font-weight:bold">Still waiting for approval from admin</h3>
	@endif
</div>
@elseif (Auth::user()->role === 3)
	<div class = "container table-responsive">
		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Waiting for Approval Company</h3>
		</div>

		<div>
			@php
				$companies = DB::table('companies')->where('companyApproval',0)->pluck('companyid');
			@endphp

			<table class = "table table-condensed">
	    		<thead>
	    			<tr>
	    				<th>Check Box</th>
	    				<th>Company Name</th>
	    				<th>Email</th>
	    			</tr>
	    		</thead>

	    		<tbody>
					@foreach($companies as $company)
						@php
							$companyName = DB::table('companies')->where('companyid', $company)->value('companyName');
							$companyUserId = DB::table('companies')->where('companyid', $company)->value('userid');
							$companyApproval = DB::table('companies')->where('companyid',$company)->value('companyApproval');
							$companyEmail = DB::table('users')->where('id',$companyUserId)->value('email');
						@endphp

					@if ($companyApproval === 0)
				    	<tr>
				    		<form action="/checkcompanyapproval" method="post" enctype="multipart/form-data">
				    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
				    		<td><input name="company[]" type="checkbox" value="{!!$company!!}"></td>
					    	<td>{!!$companyName!!}</td>
					    	<td>{!!$companyEmail!!}</td>
				    	</tr>
				    @endif
					@endforeach
				</tbody>
			</table>
			<input type="submit" name="checkCompany" class = "btn btn-default login-btn" value="Submit" />
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">Waiting for Approval Event</h3>
		</div>

		<div>
			@php
				$events = DB::table('events')->where('eventApproval',0)->pluck('eventid');
			@endphp

			<table class = "table table-condensed">
	    		<thead>
	    			<tr>
	    				<th>Check Box</th>
	    				<th>Event Name</th>
	    				<th>Organizer</th>
	    				<th>Date</th>
	    				<th>Venue</th>
	    			</tr>
	    		</thead>

	    		<tbody>
					@foreach($events as $event)
						@php
							$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
							$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
							$eventVenue = DB::table('events')->where('eventid', $event)->value('eventVenue'); 
							$companyid = DB::table('events')->where('eventid',$event)->value('companyid');
							$companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
						@endphp

				    <tr>
				    	<form action="/checkeventapproval" method="post" enctype="multipart/form-data">
				    	<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
				    	<td><input name="event[]" type="checkbox" value="{!!$event!!}"></td>
					    <td>{!!$eventName!!}</td>
					    <td>{!!$companyName!!}</td>
					    <td>{!!$eventDate!!}</td>
					    <td>{!!$eventVenue!!}</td>
				    </tr>
					@endforeach
				</tbody>
			</table>
			<input type="submit" name="checkEvent" class = "btn btn-default login-btn" value="Submit" />
		</div>

		<div class = "page-header">
			<h3 class ="text-uppercase" style="font-weight:bold">All Events Statistics</h3>
		</div>

		<div>
			@php
				$eventsStats = DB::table('events')->where('eventApproval',1)->pluck('eventid');
			@endphp
			<table class = "table table-condensed">
	    		<thead>
	    			<tr>
	    				<th>Event Name</th>
	    				<th>Organizer</th>
	    				<th>Date</th>
	    				<th>Venue</th>
	    				<th>Total Student</th>
	    			</tr>
	    		</thead>

	    		<tbody>
					@foreach($eventsStats as $eventStat)
						@php
							$eventSName = DB::table('events')->where('eventid', $eventStat)->value('eventName');
							$eventSDate = DB::table('events')->where('eventid', $eventStat)->value('eventDate');
							$eventSVenue = DB::table('events')->where('eventid', $eventStat)->value('eventVenue'); 
							$totalRegistered = DB::table('studentsnevents')->where('eventid',$eventStat)->count('studentid');
							$companySid = DB::table('events')->where('eventid',$eventStat)->value('companyid');
							$companySName = DB::table('companies')->where('companyid',$companySid)->value('companyName');
						@endphp

				    <tr>
					    <td>{!!$eventSName!!}</td>
					    <td>{!!$companySName!!}</td>
					    <td>{!!$eventSDate!!}</td>
					    <td>{!!$eventSVenue!!}</td>
					    <td><a href="/viewevent/{!!$eventStat!!}/participantdetails" id="totalRegisterDetails">{!!$totalRegistered!!}</a></td>
				    </tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>
@endif
@include('footer')
@stop