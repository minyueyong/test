<title>Gallery</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
	.carousel-inner > .item > img,
    .carousel-inner > .item > a > img 
    {
        width: 65%;
        height: 55%;
        margin: auto;
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

    
</div>

@include('footer')
@stop