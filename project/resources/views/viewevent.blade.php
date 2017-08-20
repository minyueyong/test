@php 
        $name = DB::table('events')->where('id', $id)->value('eventName');
        $date = DB::table('events')->where('id', $id)->value('eventDate');
        $venue= DB::table('events')->where('id', $id)->value('eventVenue');
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

	<img src = "{!!$image!!}" alt="eventpic" class="img-square img-responsive" style="margin: auto;"/>
	<div style="font-size:18px">Name: {!!$name!!} </div>
	<div style="font-size:18px">Date: {!!$date!!} </div>
	<div style="font-size:18px">Venue: {!!$venue!!} </div>
	<div style="font-size:18px">Description: <br>@php echo nl2br($description); @endphp </div>
    @if(Auth::user()->role === 1)
        <button type="submit" class = "btn btn-default login-btn">Participate It!</button>
    @endif
</div>
@include('footer')
@stop


