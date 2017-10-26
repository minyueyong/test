@php
	$eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');
	$students = DB::table('studentsnevents')->where('eventid', $eventid)->pluck('studentid');
@endphp

<title>Attendance for Event</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">{!!$eventName!!}</h3>
    </div>

    <div>
    	<table class = "table table-responsive table-condensed">
    		<thead>
    			<tr>
    				<th>Check Box</th>
    				<th>First Name</th>
    				<th>Last Name</th>
    				<th>Email</th>
    			</tr>
    		</thead>

    		<tbody>
		    	@foreach($students as $student)
		    		@php
		    			$studentFirstName = DB::table('students')->where('studentid', $student)->value('firstName');
		    			$studentLastName = DB::table('students')->where('studentid', $student)->value('lastName');
		    			$studentUserId = DB::table('students')->where('studentid', $student)->value('userid');
		    			$studentParticipate = DB::table('studentsnevents')->where('studentid',$student)->where(DB::raw('eventid'), $eventid)->value('participate');
		    			$studentEmail = DB::table('users')->where('id',$studentUserId)->value('email');
		    		@endphp

		    	@if ($studentParticipate === 0)
			    	<tr>
			    		<form action="/checkstudentattendance" method="post" enctype="multipart/form-data">
			    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
			    		<td><input name="student[]" type="checkbox" value="{!!$student!!}"></td>
			    		<input type="hidden" name="eventid" value="{!!$eventid!!}">
				    	<td>{!!$studentFirstName!!}</td>
				    	<td>{!!$studentLastName!!}</td>
				    	<td>{!!$studentEmail!!}</td>
			    	</tr>
			    @endif
		    	@endforeach
		    </tbody>
		</table>

		<input type="submit" name="checkAttendance" class = "btn btn-default login-btn" value="Submit" />
    </div>
</div>
@include('footer')
@stop