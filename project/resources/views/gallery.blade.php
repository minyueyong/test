<title>Gallery</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
	#pastevent
	{
		color: red;
	}

	#pastevent:hover
	{
		color: black;
	}

	ul 
	{
		list-style: disc;
		display : inline-block;
		line-height: 1em;
	}
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Gallery</h3>
    </div>

    <div class="embed-responsive embed-responsive-16by9">
       	<iframe class = "embed-responsive-item" src="https://www.youtube.com/embed/EgMXxK4MtPM" allowfullscreen></iframe>
    </div>

    <div class = "page-header">
    </div>
	
	<h3 class = "text-uppercase">Past Events' Gallery</h3>

    @php
    	$id = DB::table('events')->pluck('eventid');
    @endphp

    <ul style ="margin-left : -1cm; font-size:1.3vw;">
	    @foreach ($id as $eventid)
		  	@php
	        	$currentDate = date('Y-m-d');
	        	$eventname = DB::table('events')->where('eventid', $eventid)->value('eventName');
	        	$date = DB::table('events')->where('eventid', $eventid)->value('eventDate');
	            $approval = DB::table('events')->where('eventid',$eventid)->value('eventApproval');
	    	@endphp
	    		
	    	@if($date < $currentDate && $approval === 1)
				<li>
					<a href="/gallery/{!!$eventid!!}" id="pastevent">
			  		{!!$eventname!!}
					</a>
				</li>
			@endif
			<br>
		@endforeach
	</ul>
</div>

@include('footer')
@stop