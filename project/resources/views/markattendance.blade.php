@php
	$eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');
@endphp

<title>Attendance for Event</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">{!!$eventName!!}</h3>
    </div>
</div>
@include('footer')
@stop