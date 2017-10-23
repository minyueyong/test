<title>Forum</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
	#post
	{
		color: red;
	}

	#post:hover
	{
		color: black;
	}
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Forum</h3>
    </div>

    @php
    	$id = DB::table('posts')->pluck('postid');
    @endphp

    <div>
    	<table class = "table table-condensed">
    		<thead>
    			<tr>
    				<th>Post Title</th>
    				<th>Posted Date</th>
    				<th>Author</th>
    			</tr>
    		</thead>

    		<tbody>
		    @foreach ($id as $postid)
			  	@php
		        	$posttitle = DB::table('posts')->where('postid', $postid)->value('postTitle');
		        	$userid = DB::table('posts')->where('postid', $postid)->value('userid');
		        	$date = DB::table('posts')->where('postid',$postid)->value('created_at');
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
		        		$name = "Admin";
		        	}
		    	@endphp

		    	<tr>
			    	<td><a href="{{ url('forum/'.$postid) }}" id="post">{!!$posttitle!!}</a></td>
			    	<td>{!!$date!!}</td>
			    	<td>{!!$name!!}</td>
			   	</tr>
		    @endforeach
			</tbody>
		</table>
	</div>
    <a href="/forum/createpost" class="btn btn-default login-btn"> Create Post</a>
</div>

@include('footer')
@stop