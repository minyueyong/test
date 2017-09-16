@php 
        $name = DB::table('events')->where('id', $id)->value('eventName');
        $date = DB::table('events')->where('id', $id)->value('eventDate');
        $venue = DB::table('events')->where('id', $id)->value('eventVenue');
        $fees = DB::table('events')->where('id',$id)->value('eventFees');
        $image = DB::table('events')->where('id', $id)->value('eventImage');
        $description = DB::table('events')->where('id', $id)->value('eventDescription');
@endphp

<title>{!!$name!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">{!!$name!!}</h3>
    </div>  

	<img src = "{!!$image!!}" alt="eventpic" class="img-square img-responsive" style="height: 45%; width:35%; margin: auto;"/>
	<div style="font-size:18px">Name: {!!$name!!} </div>
	<div style="font-size:18px">Date: {!!$date!!} </div>
	<div style="font-size:18px">Venue: {!!$venue!!} </div>
    <div style="font-size:18px">Fees: {!!$fees!!} </div>
	<div style="font-size:18px">Description: <br>@php echo nl2br($description); @endphp </div>
    
    @php
        $currentDate = date('Y-m-d');
    @endphp
    @if($date > $currentDate)
        @if(Auth::user()->role === 1)
            <a href="/participateevent" class = "btn btn-default login-btn">Participate It!</a>
        @elseif(Auth::user()->role === 2)
            <a href="/participateevent" class = "btn btn-default login-btn">Mark Attendance!</a>
        @elseif(Auth::user()->role === 3)
            <a href="/participateevent" class = "btn btn-default login-btn">Stats Analytic!</a>
        @endif
    @endif
</div>
@include('footer')
@stop


