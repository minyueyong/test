<title>Forum</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Forum</h3>
    </div>

    @php
    	$id = DB::table('posts')->pluck('postid');
    @endphp

    <ul class="list-inline">
	    @foreach ($id as $postid)
	    <li>
		  	@php
	        	$posttitle = DB::table('posts')->where('postid', $postid)->value('postTitle');
	        	$userid = DB::table('posts')->where('postid', $postid)->value('userid');
	        	$date = DB::table('posts')->where('postid',$postid)->value('created_at');
	        	$role = DB::table('users')->where('id',$userid)->value('role');
	    	@endphp
	    	{!!$posttitle!!}
	    	{!!$date!!}
	    	{!!$role!!}
	   	</li>
	    @endforeach
	</ul>
    <a href="/forum/createpost" class="btn btn-default login-btn"> Create Post</a>
</div>

@include('footer')
@stop