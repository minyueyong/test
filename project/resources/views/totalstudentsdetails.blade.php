@php
	$students = DB::table('students')->pluck('studentid');
@endphp

<title>Total Students Details</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">Total Students Details</h3>
    </div>

    <div>
    	<table class = "table table-condensed">
    		<thead>
    			<tr>
    				<th>First Name</th>
    				<th>Last Name</th>
    				<th>Email</th>
    				<th>Phone</th>
    				<th>Campus</th>
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
		    			$studentCampus = DB::table('students')->where('studentid',$student)->value('campus');
		    		@endphp
			    	<tr>
				    	<td>{!!$studentFirstName!!}</td>
				    	<td>{!!$studentLastName!!}</td>
				    	<td>{!!$studentEmail!!}</td>
				    	<td>0{!!$studentPhone!!}</td>
				    	<td>{!!$studentCampus!!} University</td>
			    	</tr>
		    	@endforeach
		    </tbody>
		</table>
    </div>
</div>
@include('footer')
@stop