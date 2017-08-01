<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet">
	<div class = "container">
		<img src = "/upload/{!!Auth::user()->image!!}" alt="profilepic" class="img-rounded center-block img-responsive" height="200" width="100"/>
		<h4> {!!Auth::user()->firstName!!} {!!Auth::user()->lastName!!}</h4> 
		<h4> Member since {!!Auth::user()->created_at!!}</h4>
	</div>
@include('footer')
@stop