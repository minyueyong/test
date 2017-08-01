<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet">
	<div class = "container">
			<h4> {!!Auth::user()->firstName!!} {!!Auth::user()->lastName!!}</h4> 
			<h4> Member since {!!Auth::user()->created_at!!}</h4>
			<img src = "/upload/{!!Auth::user()->image!!}"/>
	</div>
@include('footer')
@stop