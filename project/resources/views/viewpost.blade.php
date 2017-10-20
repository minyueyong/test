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

    <div>
    	@php echo nl2br($postdescription); @endphp
   	</div>
</div>

@include('footer')
@stop