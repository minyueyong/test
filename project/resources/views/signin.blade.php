<title>Sign In</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet"> 

<div class="container">
    <div class="imgcontainer">
        <img src="images/blogo2.png" alt = "blogo2" class = "img-rounded   center-block img-responsive">
    </div>

    <div class="page-login-form box">
        <form role="form" class="login-form" method="POST" action="/checksignin">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
        <div class = "form-group">
            <div class="input-icon">
                <span class="glyphicon glyphicon-user"></span> <input type="email" placeholder="Enter Email" name="useremail" id = "useremail" class = "form-control" required>
            </div>
        </div>

        <div class = "form-group">
            <div class="input-icon">
                <span class="glyphicon glyphicon-lock"></span> <input type="password" placeholder="Enter Password" name="userpw" id = "userpw" class = "form-control" required>
            </div>
        </div>

        <button type="submit" class = "btn btn-default login-btn">Login</button> 
        <br>
        <input type="checkbox"> Remember me

        <br>
        <label>Don't have an account? <a href="signup" id = "signup">Sign up</a> now. </label>
        </form>
    </div>    
</div>
@include('footer')
@stop
