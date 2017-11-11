<title>Upgrade Membership</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Upgrade Membership</h3>
    </div>

    <div class="page-login-form box">
	    <form role="form" class="login-form" method="POST" action="/checkupgrademembership" enctype="multipart/form-data">
	        <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
		    <div class="form-group">
		        <div class="input-icon"> <span class="glyphicon glyphicon-user"></span>
			        <select name = "status" id ="status" required>
			            <option value = "" selected disabled>Membership Status </option>
			            <option value="Basic">Basic </option>
			            <option value="Popular">Popular </option>
			            <option value="Epic">Epic </option>
			        </select>
		    	</div>
			</div>
			<button type="submit" class = "btn btn-default login-btn">Upgrade Membership</button>
		</form>
	</div>
</div>

@include('footer')
@stop