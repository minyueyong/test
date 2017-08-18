<title>Sign Up</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>
<style>
	#studentbutton, #companybutton
	{
		height: 15%;
		width: 35%;
	}
</style>

<div class="container">
	<div class = "page-header">
        <h3 class = "text-uppercase">Sign Up as</h3>
    </div>

    <br><br>
  	<a href = "{{ url('studentsignup') }}" class="btn btn-default login-btn" id="studentbutton">Student</a>
  	&nbsp;&nbsp;
  	OR
  	&nbsp;&nbsp;
  	<a href = "{{ url('companysignup') }}" class="btn btn-default login-btn" id="companybutton">Company</a>
</div>

@include('footer')
@stop