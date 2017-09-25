<title>MONSTA</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
  .image1 
  { 
    /* The image used */
    background-image: url("images/home3.jpg");
      
    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .image2 
  { 
    /* The image used */
    background-image: url("images/home1.jpg");
      
    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .image3 
  { 
    /* The image used */
    background-image: url("images/home4.jpg");
      
    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
   
  .image4 
  { 
    /* The image used */
    background-image: url("images/home2.jpg");
      
    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .image1 h2 
  { 
    position: absolute; 
    top: 100px; 
    left: 0; 
    width: 100%; 
  }

  .image1 h2 span 
  { 
    color: white; 
    font: bold 24px/45px Helvetica, Sans-Serif; 
    letter-spacing: -1px;  
    background: rgb(0, 0, 0); /* fallback color */
    background: rgba(0, 0, 0, 0.7);
    padding: 10px; 
  }

  h2 span.spacer1 
  {
     padding:0 5px;
  }

  .image2 h2 
  { 
    position: absolute; 
    top: 770px; 
    left: 0; 
    width: 100%; 
  }

  .image2 h2 span 
  { 
    color: white; 
    font: bold 24px/45px Helvetica, Sans-Serif; 
    letter-spacing: -1px;  
    background: rgb(0, 0, 0); /* fallback color */
    background: rgba(0, 0, 0, 0.7);
    padding: 10px; 
  }

  .image2 h2 span.spacer2 
  {
     padding:0 5px;
  }

  .image3 h2 
  { 
    position: absolute; 
    top: 1250px; 
    left: 0; 
    width: 100%; 
  }

  .image3 h2 span 
  { 
    color: white; 
    font: bold 24px/45px Helvetica, Sans-Serif; 
    letter-spacing: -1px;  
    background: rgb(0, 0, 0); /* fallback color */
    background: rgba(0, 0, 0, 0.7);
    padding: 10px; 
  }

  .image3 h2 span.spacer3 
  {
    padding:0 5px;
  }

  .image4 h2 
  { 
    position: absolute; 
    top: 1950px; 
    left: 0; 
    width: 100%; 
  }

  .image4 h2 span 
  { 
    color: white; 
    font: bold 24px/45px Helvetica, Sans-Serif; 
    letter-spacing: -1px;  
    background: rgb(0, 0, 0); /* fallback color */
    background: rgba(0, 0, 0, 0.7);
    padding: 10px; 
  }

  .image4 h2 span.spacer4 
  {
    padding:0 5px;
  }
</style>

<div>
  <div class="image1"> 
        <h2><span>Welcome To Monsta <span class='spacer1'></span><br /><br><span class='spacer1'></span>Everyone goes to college, and everyone join activities.<br> So what makes you special? You need experience you cannot get inside your college.<br>Make like-minded friends with students from 50 universities.<br> Engage into special projects and opportunities with friends.<br> 
          LEARNING CAN BE FUN! </span><br><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/aboutus")}}'">KNOW MORE</button></h2>
  </div>

  <div class="image2"> 
      <h2><span>Discover Your Passion<span class='spacer2'></span><br /><br><span class='spacer2'></span>Join the community and make friends,<br> with students from over 50 universities <br>
      across Malaysia. Build quality network and gain<br> access to exclusive hands on opportunities. </span> <br><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/signup")}}'">Come and join us</button> </h2>
  </div>

  <div class="image3"> 
      <h2><span>When We Are Young<span class='spacer3'></span><br /><br><span class='spacer3'></span>  
  Never settle with JUST good,<br> excellent is still one step away, BE OUTSTANDING.<br>
  One way to be outstanding is to learn from bigger players,<br> foster a collaborative mentality to make<br> a remarkable experience during campus life.<br>
  We happen to provide industry opportunities through<br> a collaborative community across university!
   </span> <br><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/gallery")}}'">HAVE A LOOK</button> </h2>
  </div>

  <div class="image4"> 
      <h2><span>Join Campaigns<span class='spacer4'></span><br /><br><span class='spacer4'></span>Join Monsta University Network to build your <br> EXPERIENCE to discover your PASSION <br>and MAKE AN IMPACT. 
      </span> <br><br><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/events")}}'">SEE UPCOMING EVENTS</button> </h2>
  </div>
</div>
@include('footer')
@stop