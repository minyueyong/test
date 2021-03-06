@php
	$events = DB::table('events')->pluck('eventid');
@endphp

<title>Total Activities Details</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">Total Activities Details</h3>
    </div>

    <div>
    	<table class = "table table-responsive table-condensed">
    		<thead>
    			<tr>
    				<th>Activity Name</th>
    				<th>Date</th>
    				<th>Venue</th>
    				<th>Seats Left</th>
    				<th>Organizer</th>
    			</tr>
    		</thead>

    		<tbody>
		    	@foreach($events as $event)
		    		@php
		    			$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
					    $eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
					    $eventVenue = DB::table('events')->where('eventid', $event)->value('eventVenue');
					    $eventSeats = DB::table('events')->where('eventid', $event)->value('eventSeats');
					    $totalRegistered = DB::table('studentsnevents')->where('eventid',$event)->count('studentid');
					    $companyid = DB::table('events')->where('eventid', $event)->value('companyid');
					    $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
					    $seatsLeft = $eventSeats - $totalRegistered;
		    		@endphp
			    	<tr>
				    	<td>{!!$eventName!!}</td>
				    	<td>{!!$eventDate!!}</td>
				    	<td>{!!$eventVenue!!}</td>
				    	<td>{!!$seatsLeft!!}</td>
				    	<td>{!!$companyName!!}</td>
			    	</tr>
		    	@endforeach
		    </tbody>
		</table>
    </div>
</div>
@include('footer')
@stop