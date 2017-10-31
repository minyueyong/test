@php
	if (Auth::user()->role == 2)
	{
		$companyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
		$approval = DB::table('companies')->where('companyid',$companyid)->value('companyApproval');
	}
	else
	{
		$approval = 1;
	}
@endphp

<title>Forum</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

<style>
	#post
	{
		color: red;
	}

	#post:hover
	{
		color: black;
	}

	.pagination > li > a, .pagination > li > span
	{
		background-color: white;
		color: red;
	}

	.pagination > li.active > a, .pagination > li.active > span
	.pagination > li.active > a:visited, .pagination > li.active > span
	{
		background-color: red;
		border-color: transparent;
	}

	.pagination > li.active > a:hover
	{
		background-color: grey;
		color: white;
	}
</style>

<script>
$(document).ready(function() 
{
    $('#forumtable').DataTable({
    	"aLengthMenu": [[1, 3, 5, -1], [1, 3, 5, "All"]],
        "iDisplayLength": 1
    });
} );
</script>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Forum</h3>
    </div>

    @if ($approval == 1)
	    @php
	    	$id = DB::table('posts')->pluck('postid');
	    @endphp

	    <div>
	    	<table id="forumtable" class="table table-striped row-border" cellspacing="0" width="100%">
	    		<thead>
	    			<tr>
	    				<th>Post Title</th>
	    				<th>Posted Date</th>
	    				<th>Author</th>
	    				<th>Last Replied</th>
	    			</tr>
	    		</thead>

	    		<tbody>
			    @foreach ($id as $postid)
				  	@php
			        	$posttitle = DB::table('posts')->where('postid', $postid)->value('postTitle');
			        	$userid = DB::table('posts')->where('postid', $postid)->value('userid');
			        	$date = DB::table('posts')->where('postid',$postid)->value('created_at');
			        	$role = DB::table('users')->where('id',$userid)->value('role');
            			$postcommentsid = DB::table('usersnpostsncomments')->where('postid',$postid)->max('postcommentid');
            			$lastreplieduserid = DB::table('usersnpostsncomments')->where('postcommentid',$postcommentsid)->value('userid');
            			$lastrepliedrole = DB::table('users')->where('id',$lastreplieduserid)->value('role');

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

			        	$lastrepliedname = "None";

			        	if ($lastrepliedrole == 1)
			        	{
			        		$lastrepliedname = DB::table('students')->where('userid',$lastreplieduserid)->value('firstName');
			        	}

			        	else if ($lastrepliedrole == 2)
			        	{
			        		$lastrepliedname = DB::table('companies')->where('userid',$lastreplieduserid)->value('companyName');
			        	}

			        	else if ($lastrepliedrole == 3)
			        	{
			        		$lastrepliedname = "Admin";
			        	}
			    	@endphp

			    	<tr>
				    	<td><a href="{{ url('forum/'.$postid) }}" id="post">{!!$posttitle!!}</a></td>
				    	<td>{!!$date!!}</td>
				    	<td>{!!$name!!}</td>
				    	<td>{!!$lastrepliedname!!}</td>
				   	</tr>
			    @endforeach
				</tbody>
			</table>
		</div>
	    <a href="/forum/createpost" class="btn btn-default login-btn"> Create Post</a>
	@else 
		<h3 class ="text-uppercase" style="font-weight:bold; color: #FF7171">Still waiting for approval from admin</h3>
	@endif
</div>

@include('footer')
@stop