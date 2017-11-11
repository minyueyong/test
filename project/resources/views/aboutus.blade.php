<title>About Us</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
.image 
{
    text-align:center;
}
</style>

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
        <img src="{{ asset('images/subscriptionfees.png') }}" alt = "subscriptionfees" class = "img-rounded center-block img-responsive">
    </div>

    <div class = "page-header">
        <h3 class = "text-uppercase">Join Us</h3>
    </div>

    <h5 class = "text-uppercase lead">Monsta University Network</h5>
    <blockquote id = "joinUs">
        <p>It is not what you could learn, but how much connection you could make during your internship.</p>
        <p>You can improve your skill that will provide a platform for you to explore the suitable career path for your future.</p>
    </blockquote>

    <div class="image">
        <img src="{{ asset('images/perks.jpg') }}" height = "300" width ="280" alt = "perks">
        <img src="{{ asset('images/perks2.jpg') }}" height = "300" width ="280" alt = "perks2">
        <img src="{{ asset('images/perks3.jpg') }}" height = "300" width ="280" alt = "perks3">
    </div>
</div>

@include('footer')
@stop