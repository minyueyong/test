<title>Event Page</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container" style="font-size:18px">
    <div class = "page-header">
        <h3 class = "text-uppercase">Event Page</h3>
    </div>
        
    @php 
       	$name = DB::table('events')->where('id', $id)->value('eventName');
	@endphp

	<div>Event Name: {!!$name!!} </div>
</div>
@include('footer')
@stop


