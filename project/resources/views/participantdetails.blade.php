@php
	$eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');
	$students = DB::table('studentsnevents')->where('eventid', $eventid)->pluck('studentid');
@endphp

<title>Participant Details</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">{!!$eventName!!}</h3>
    </div>

    <div>
    	<table class = "table table-condensed">
    		<thead>
    			<tr>
    				<th>First Name</th>
    				<th>Last Name</th>
    				<th>Email</th>
    				<th>Phone</th>
    			</tr>
    		</thead>

    		<tbody>
		    	@foreach($students as $student)
		    		@php
		    			$studentFirstName = DB::table('students')->where('studentid', $student)->value('firstName');
		    			$studentLastName = DB::table('students')->where('studentid', $student)->value('lastName');
		    			$studentUserId = DB::table('students')->where('studentid', $student)->value('userid');
		    			$studentEmail = DB::table('users')->where('id',$studentUserId)->value('email');
		    			$studentPhone = DB::table('students')->where('studentid',$student)->value('phone');
		    		@endphp
			    	<tr>
				    	<td>{!!$studentFirstName!!}</td>
				    	<td>{!!$studentLastName!!}</td>
				    	<td>{!!$studentEmail!!}</td>
				    	<td>+60{!!$studentPhone!!}</td>
			    	</tr>
		    	@endforeach
		    </tbody>
		</table>
    </div>
</div>
@include('footer')
@stop