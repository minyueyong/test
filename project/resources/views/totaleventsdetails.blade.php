@php
	$events = DB::table('events')->pluck('eventid');
@endphp

<title>Total Events Details</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">Total Events Details</h3>
    </div>

    <div>
    	<table class = "table table-responsive table-condensed">
    		<thead>
    			<tr>
    				<th>Event Name</th>
    				<th>Date</th>
    				<th>Venue</th>
    				<th>Organizer</th>
    			</tr>
    		</thead>

    		<tbody>
		    	@foreach($events as $event)
		    		@php
		    			$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
					    $eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
					    $eventVenue = DB::table('events')->where('eventid', $event)->value('eventVenue');
					    $companyid = DB::table('events')->where('eventid', $event)->value('companyid');
					    $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
		    		@endphp
			    	<tr>
				    	<td>{!!$eventName!!}</td>
				    	<td>{!!$eventDate!!}</td>
				    	<td>{!!$eventVenue!!}</td>
				    	<td>{!!$companyName!!}</td>
			    	</tr>
		    	@endforeach
		    </tbody>
		</table>
    </div>
</div>
@include('footer')
@stop