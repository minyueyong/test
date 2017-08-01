<title>Past Speakers</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"> 

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
                <h3 class = "text-uppercase">Speakers</h3>
    </div>
    <h5>Proud to bring inspirational speakers from across the globe</h5>

    <div id = "speakers" class = "carousel slide" data-ride = "carousel" data-interval = "3000">
        <ol class = "carousel-indicators">
            <li data-target = "#speakers" data-slide-to = "0" class = "active"></li>
            <li data-target = "#speakers" data-slide-to = "1"></li>
            <li data-target = "#speakers" data-slide-to = "2"></li>
        </ol>

        <div class = "carousel-inner" role = "listbox">
            <div class = "item active">
                <img src = "images/speaker1.jpg" alt = "speaker1" height = "200" width = "100">
            </div>

            <div class = "item">
                <img src = "images/speaker2.jpg" alt = "speaker2" height = "200" width = "100">
            </div>

            <div class = "item">
                <img src = "images/speaker3.jpg" alt = "speaker3" height = "200" width = "100">
            </div>
        </div>

        <a class="left carousel-control" href="#speakers" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#speakers" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@include('footer')
@stop