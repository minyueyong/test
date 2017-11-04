<title>Gallery</title>
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
    
    /* Smartphones (portrait) ----------- */
    @media only screen and (max-width : 480px)
    {
        .img-thumbnail
        {
            width: 65%;
            height: 25%;
            margin: auto;
        }
    }

	#pastevent
	{
		color: red;
		
	}

	#pastevent:hover
	{
		color: black;
	}

	#events
	{
		list-style:none;
		display : inline-block;
		line-height: 1em;	
	}

	/* Smartphones (portrait) ----------- */
	@media only screen and (max-width : 480px)
	{
  		#pasteventlink
  		{
  			font-size: 4vw;
  		}
	}
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Gallery</h3>
    </div>

   @php
    	$id = DB::table('events')->pluck('eventid');
    @endphp

    <ul class="list-inline">
	    @foreach ($id as $eventid)
		<li id = "pasteventlink" style="float:left">
		  	@php
	        	$currentDate = date('Y-m-d');
	        	$eventname = DB::table('events')->where('eventid', $eventid)->value('eventName');
	        	$date = DB::table('events')->where('eventid', $eventid)->value('eventDate');
	            $approval = DB::table('events')->where('eventid',$eventid)->value('eventApproval');
				$image = DB::table('events')->where('eventid',$eventid)->value('eventImage');
	    	@endphp
	    		
	    	@if($date < $currentDate && $approval === 1)				
				<a href="/gallery/{!!$eventid!!}" id="pastevent">
                	<img class="img-thumbnail" src="{!!$image!!}">
                	<br>
                	{!!$eventname!!}
            	</a>
			@endif
		@endforeach
		</li>
	</ul>
</div>

@include('footer')
@stop