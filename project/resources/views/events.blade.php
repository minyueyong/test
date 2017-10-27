<title>Activities</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
	.img-thumbnail
    {
        width: 55%;
        height: 35%;
        margin: auto;
    }	
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Activities</h3>
    </div>
    
    <ul class="list-inline">
    	@php 
		  	$id = DB::table('events')->pluck('eventid');
		@endphp

		@foreach ($id as $eventid)
	  	<li>
	  		@php
        		$currentDate = date('Y-m-d');
        		$eventname = DB::table('events')->where('eventid', $eventid)->value('eventName');
        		$date = DB::table('events')->where('eventid', $eventid)->value('eventDate');
        		$image = DB::table('events')->where('eventid', $eventid)->value('eventImage');
                $approval = DB::table('events')->where('eventid',$eventid)->value('eventApproval');
    		@endphp
    		
    		@if($date >= $currentDate && $approval === 1)
		  	<a href="{{ url('viewevent/'.$eventid) }}" id="thumbnail">
		  		<img class="img-thumbnail" src="{!!$image!!}">
		  		<br>
				{!!$eventname!!}
			</a>
			@endif
		@endforeach
        </li>
	<!--end of thumbnails-->
	</ul>
</div>
@include('footer')
@stop