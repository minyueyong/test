<title>Join Us</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
        <div class = "page-header">
                <h3 class = "text-uppercase">Join Us</h3>
        </div>

        <h5 class = "text-uppercase lead">Monsta University Network</h5>
        <blockquote id = "joinUs">
	        <p>It is not what you could learn, but how much connection you could make during your internship.</p>
			<p>You can improve your skill that will provide a platform for you to explore the suitable career path for your future.</p>
		</blockquote>

        <div class="imgcontainer">
                <img src="{{ asset('images/perks.jpg') }}" alt = "perks" class = "img-rounded center-block img-responsive">
        </div>

        <div class="imgcontainer">
                <img src="{{ asset('images/perks2.jpg') }}" alt = "perks2" class = "img-rounded center-block img-responsive">
        </div>

        <div class="imgcontainer">
                <img src="{{ asset('images/perks3.jpg') }}" alt = "perks3" class = "img-rounded center-block img-responsive">
        </div>
</div>

@include('footer')
@stop
