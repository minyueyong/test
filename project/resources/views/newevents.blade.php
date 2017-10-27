@if ($interest != "All")
    <title>Activities in {!!$interest!!} Area</title>
@else
    <title>All Activites</title>
@endif
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
</style>

<div class = "container">
    <div class = "page-header">
        @if ($interest != "All")
            <h3 class = "text-uppercase">Activities in {!!$interest!!} Area</h3>
        @else
            <h3 class = "text-uppercase">All Activities</h3>
        @endif
    </div>
    
    <form role="form" class="login-form" method="POST" action="/checkinterestoption" enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
        <select name="interestdropdown" id="interestdropdown" onchange='this.form.submit()'>
            <option value = "" selected disabled>Area of Interest </option>
            <option value="Art">Art </option>
            <option value="Information Technology">Information Technology</option>
            <option value="Business">Business </option>
            <option value="Mass Comm">Mass Comm </option>
            <option value="Law">Law</option>
            <option value="All">All</option>
        </select>
        <noscript><input type="submit" value="Submit"/></noscript>
    </form>

    <ul class="list-inline">
    	@php 
            if ($interest == "All")
                $id = DB::table('events')->orderBy('eventDate', 'asc')->pluck('eventid');
            else
		  	   $id = DB::table('events')->where('eventInterest',$interest)->orderBy('eventDate', 'asc')->pluck('eventid');
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