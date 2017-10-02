<title>MONSTA</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<style>
    .image1 
    { 
      /* The image used */
      background-image: url("images/home1.jpg");
        
      /* Full height */
      height: 100%;
      max-width : 100%;
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    div.transbox 
    {
      top: 50px; 
      left: 0; 
      position: absolute; 
      margin: 80px;
      background-color: #ffffff;
      border: 1px transparent;
      opacity: 0.65;

    }

    div.transbox p 
    {
      margin: 5%;
      font-size: 17px;
      color: #000000;
    }

    .image2 
    { 
      /* The image used */
      background-image: url("images/home2.jpg");
        
      /* Full height */
      height: 100%;
      max-width : 100%;
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    div.transbox1 
    {
      top: 720px; 
      left: 0; 
      position: absolute; 
      margin: 80px;
      background-color: #ffffff;
      border: 1px transparent;
      opacity: 0.65;

    }

    div.transbox1 p 
    {
      margin: 5%;
      font-size: 17px;
      color: #000000;
    }

    .image3 
    { 
      /* The image used */
      background-image: url("images/home3.jpg");
        
      /* Full height */
      height: 100%;
      max-width : 100%;
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    div.transbox2 
    {
      top: 1330px; 
      left: 0; 
      position: absolute; 
      margin: 80px;
      background-color: #ffffff;
      border: 1px transparent;
      opacity: 0.65;
    }

    div.transbox2 p 
    {
      margin: 5%;
      font-size: 17px;
      color: #000000;
    }
    
    .image4 
    { 
      /* The image used */
      background-image: url("images/home4.jpg");
        
      /* Full height */
      height: 100%;
      max-width : 100%;
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    div.transbox3 
    {
      top: 2015px; 
      left: 0; 
      position: absolute; 
      margin: 80px;
      background-color: #ffffff;
      border: 1px transparent;
      opacity: 0.65;
    }

    div.transbox3 p 
    {
      margin: 5%;
      font-size: 17px;
      color: #000000;
    }

    #lbutton
    {
      border-color: red;
    }
</style>

<div>
  <div class="image1"> 
      <div class ="transbox">
        <p><font size="6"><b>Welcome To Monsta</b></font></p>
        <p><b> 
            Everyone goes to college, and everyone join activities.<br> 
            So what makes you special? You need experience you <br>
            cannot get inside your college.
            Make like-minded friends <br> 
            with students from 50 universities. Engage into special <br>
            projects and opportunities with friends. LEARNING CAN BE FUN!</b> <br> <br>
            <button type = "button" id="lbutton" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/aboutus")}}'">KNOW MORE</button>
        </p>
      </div>
  </div>

  <div class="image2"> 
      <div class ="transbox1">
        <p><font size="6"><b>Discover Your Passion</b></font></p>
          <p><b> 
          Join the community and make friends, with students from <br>
          over 50 universities across Malaysia. Build quality network <br>
          and gain access to exclusive hands on opportunities.
          </b> <br> <br>
          <button type = "button" id="lbutton" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/signup")}}'">COME AND JOIN US</button>
        </p>
      </div>
  </div>

  <div class="image3"> 
      <div class ="transbox2">
        <p><font size="6"><b>When We Are Young</b></font></p>
        <p><b> 
          Never settle with JUST good, excellent is still one step away,<br> 
          BE OUTSTANDING. One way to be outstanding is to learn<br> 
          from bigger players, foster a collaborative mentality to make <br>
          a remarkable experience during campus life.
          We happen to <br>
          provide industry opportunities through a collaborative<br>
          community across university!
          </b> <br> <br>
          <button type = "button" id="lbutton" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/gallery")}}'">HAVE A LOOK</button>
        </p>
      </div>
  </div>

  <div class="image4"> 
      <div class ="transbox3">
        <p><font size="6"><b>Join Campaign</b></font></p>
        <p><b> 
          Join Monsta University Network to build your EXPERIENCE <br>
          to discover your PASSION and MAKE AN IMPACT.
          </b> <br> <br>
          <button type = "button" id="lbutton" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/events")}}'">HAVE A LOOK</button>
        </p>
      </div>
  </div>
</div>
@include('footer')
@stop