<title>Create a Post</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>
	<div class="container">
        <div class = "page-header">
            <h3 class = "text-uppercase">Create a Post</h3>
        </div>

		<div class="page-login-form box">
        	<form role="form" class="login-form" method="POST" action="/storepost" enctype="multipart/form-data">
        		<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
        			<div class = "form-group">
            				<div class="input-icon">
                				<span class="glyphicon glyphicon-pencil"></span> <input type="text" placeholder="Post Title" name="posttitle" id = "posttitle" class = "form-control" required/>
            				</div>
       			 	</div>

                    <div class="form-group">
                        <div class="input-icon">
                            <span style="vertical-align:top;" class="glyphicon glyphicon-Pencil"></span> <textarea rows="5" cols="60" maxlength="100" id="postdescription" name="postdescription" placeholder = "Post Description" required></textarea>
                        </div>
                    </div>
                <button type="submit" class = "btn btn-default login-btn">Create It</button>
		  </form>
        </div>
	</div>
@include('footer')
@stop