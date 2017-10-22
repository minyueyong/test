@php
	$posttitle = DB::table('posts')->where('postid', $id)->value('postTitle');
	$userid = DB::table('posts')->where('postid', $id)->value('userid');
	$date = DB::table('posts')->where('postid',$id)->value('created_at');
	$role = DB::table('users')->where('id',$userid)->value('role');
	if ($role == 1)
	{
		$name = DB::table('students')->where('userid',$userid)->value('firstName');
	}

	else if ($role == 2)
	{
		$name = DB::table('companies')->where('userid',$userid)->value('companyName');
	}

	else if ($role == 3)
	{
		$name = "admin";
	}	  
	$postdescription = DB::table('posts')->where('postid',$id)->value('postDescription');  	
@endphp

<title>{!!$posttitle!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">{!!$posttitle!!}</h3>
    </div>

    <div style="text-align: left">
    	by {!!$name!!}
    	on {!!$date!!}
    	<br>
    	@php echo nl2br($postdescription); @endphp
   	</div>

   	<br>
   	<div style="text-align: left">
   		@php 
            $postcommentsid = DB::table('usersnpostsncomments')->where('postid',$id)->pluck('postcommentid');
        @endphp

        @foreach ($postcommentsid as $postcommentid)
            @php
                $postcomment = DB::table('postcomments')->where('postcommentid',$postcommentid)->value('postcomment');
                $created_at = DB::table('postcomments')->where('postcommentid',$postcommentid)->value('created_at');
                $userid = DB::table('usersnpostsncomments')->where('postcommentfid',$postcommentid)->value('userid');
                $userrole = DB::table('users')->where('id',$userid)->value('role');
                if ($userrole == 1)
                {
                    $studentFName = DB::table('students')->where('userid',$userid)->value('firstName');
                }
                else if ($userrole == 2)
                {
                    $companyname = DB::table('companies')->where('userid',$userid)->value('companyName');
                }
            @endphp
                    
            @if ($userrole == 1)
                by {!!$studentFName!!} on {!!$created_at!!}<br>
                {!!$postcomment!!}<br>
            @elseif ($userrole == 2)
                by {!!$companyname!!} on {!!$created_at!!}<br>
                {!!$postcomment!!}<br>
            @elseif ($userrole == 3)
                by Admin on {!!$created_at!!}<br>
                {!!$postcomment!!}<br>
            @endif
            <br>
        @endforeach
   	</div>

   	<br>
   	<div class="page-login-form box" style="text-align:left">
        <form role="form" class="login-form" method="POST" action="/forum/{!!$id!!}/postcomment" enctype="multipart/form-data">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                <div class = "form-group">
                    <div class="input-icon">
                        <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="postcomment" name="postcomment" placeholder="Please comment here..."></textarea>
                    </div>
                </div>
                    
                <button type="submit" class = "btn btn-default login-btn" style="display:block">Reply Post</button>
        </form>
    </div>
</div>

@include('footer')
@stop