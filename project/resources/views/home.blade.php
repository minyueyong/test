@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <br><br>
    <img src = "{{ asset('images/blogo.png') }}" alt = "blogo" class = "img-rounded center-block img-responsive">
                
    <br><br>
    <div class = "page-header">
        <h3 class = "text-uppercase">Upcoming Events</h3>
    </div>
    <div id = "featuredevent" class = "carousel slide" data-ride = "carousel" data-interval = "3000">
        <ol class = "carousel-indicators">
            <li data-target = "#featuredevent" data-slide-to = "0" class = "active"></li>
            <li data-target = "#featuredevent" data-slide-to = "1"></li>
        </ol>

        <div class = "carousel-inner" role = "listbox">
            <div class = "item active">
                <img src = "{{ asset('images/featuredevent1.png') }}" alt = "featuredevent1" height = "200" width = "100">
            </div>

            <div class = "item">
                <img src = "{{ asset('images/featuredevent2.png') }}" alt = "featuredevent2" height = "200" width = "100">
            </div>
        </div>

        <a class="left carousel-control" href="#featuredevent" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#featuredevent" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <br><br>
    <div class = "page-header">
        <h3 class = "text-uppercase">Past Events</h3>
    </div>
    <div id = "upcomingevent" class = "carousel slide" data-ride = "carousel" data-interval = "3000">
        <ol class = "carousel-indicators">
            <li data-target = "#upcomingevent" data-slide-to = "0" class = "active"></li>
            <li data-target = "#upcomingevent" data-slide-to = "1"></li>
        </ol>

        <div class = "carousel-inner" role = "listbox">
            <div class = "item active">
                <img src = "{{ asset('images/upcomingevent1.png') }}" alt = "featuredevent1" height = "200" width = "100">
            </div>

            <div class = "item">
                <img src = "{{ asset('images/upcomingevent2.png') }}" alt = "featuredevent2" height = "200" width = "100">
            </div>
        </div>

        <a class="left carousel-control" href="#upcomingevent" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#upcomingevent" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@include('footer')
@stop