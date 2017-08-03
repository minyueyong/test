<title>About Us</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
        <div class = "page-header">
                <h3 class = "text-uppercase">About Us</h3>
        </div>

        <blockquote>
                <p class = "lead">Hello! We are MONSTA!</p>
                <p>Monsta is the largest student run collaborative community to gain experience, network and knowledge in Malaysia.</p>
                <p>Never settle with JUST good, excellent is still one step away, BE OUTSTANDING.</p>
                <p>Our way to be outstanding is to learn from bigger players, foster a collaborative mentality to make a remarkable experience during campus life.</p>    
                <p>We happen to provide industry opportunities through a collaborative community across universities!</p>
        </blockquote>

        <div class="imgcontainer">
                <img src="images/subscriptionfees.png" alt = "subscriptionfees" class = "img-rounded center-block img-responsive">
        </div>
</div>

@include('footer')
@stop

