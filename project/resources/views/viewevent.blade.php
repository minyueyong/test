@php 
        $name = DB::table('events')->where('eventid', $id)->value('eventName');
        $date = DB::table('events')->where('eventid', $id)->value('eventDate');
        $venue = DB::table('events')->where('eventid', $id)->value('eventVenue');
        $interest = DB::table('events')->where('eventid',$id)->value('eventInterest');
        $fees = DB::table('events')->where('eventid',$id)->value('eventFees');
        $image = DB::table('events')->where('eventid', $id)->value('eventImage');
        $description = DB::table('events')->where('eventid', $id)->value('eventDescription');
        $companyid = DB::table('events')->where('eventid', $id)->value('companyid');
        $totalRegistered = DB::table('studentsnevents')->where('eventid',$id)->count('studentid');
        $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
@endphp

<title>{!!$name!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">{!!$name!!}</h3>
    </div>  

	<img src = "{!!$image!!}" alt="eventpic" class="img-square img-responsive" style="height: 45%; width:35%; margin: auto;"/>
	<div style="font-size:18px">Name: {!!$name!!} </div>
    <div style="font-size:18px">Organizer: {!!$companyName!!} </div>
	<div style="font-size:18px">Date: {!!$date!!} </div>
	<div style="font-size:18px">Venue: {!!$venue!!} </div>
    <div style="font-size:18px">Area of Interest: {!!$interest!!} </div>
    <div style="font-size:18px">Fees: {!!$fees!!} </div>
	<div style="font-size:18px">Description: <br>@php echo nl2br($description); @endphp </div>
    <div style="font-size:18px">Total Student: {!!$totalRegistered!!} </div>
    
    @if(Auth::check())
        @php
            $currentDate = date('Y-m-d');
        @endphp
        @if($date > $currentDate)
            @if(Auth::user()->role === 1)
                <a href="/viewevent/{!!$id!!}/participateevent" class = "btn btn-default login-btn">Participate It!</a>
            @elseif(Auth::user()->role === 2)
                @php
                    $verifyCompanyId = DB::table('companies')->join('users',function ($join)
                    {
                        $join->on('companies.userid','=','users.id')->where('companies.userid','=', Auth::user()->id);
                    })->value('companies.companyid');
                @endphp
                @if($companyid === $verifyCompanyId)
                    <a href="/viewevent/{!!$id!!}/participantdetails" class = "btn btn-default login-btn">Stats Analytic</a>
                     <a href="/viewevent/{!!$id!!}/editevent" class = "btn btn-default login-btn">Edit Event</a>
                @endif
            @elseif(Auth::user()->role === 3)
                <a href="/viewevent/{!!$id!!}/participantdetails" class = "btn btn-default login-btn">Stats Analytic</a>
            @endif
        @elseif($date == $currentDate)
            @if(Auth::user()->role === 2)
                <a href="/viewevent/{!!$id!!}/participateevent" class = "btn btn-default login-btn">Mark Attendance</a>
            @endif
        @endif

        <div class = "page-header"></div>
        <h3 class = "text-uppercase">Comment Section</h3>
        @php 
            $commentsid = DB::table('usersneventsncomments')->where('eventid',$id)->pluck('commentid');
        @endphp

        @foreach ($commentsid as $commentid)
            @php
                $comment = DB::table('comments')->where('commentid',$commentid)->value('comment');
                $created_at = DB::table('comments')->where('commentid',$commentid)->value('created_at');
                $userid = DB::table('usersneventsncomments')->where('commentfid',$commentid)->value('userid');
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
                {!!$comment!!}<br>
            @elseif ($userrole == 2)
                by {!!$companyname!!} on {!!$created_at!!}<br>
                {!!$comment!!}<br>
            @elseif ($userrole == 3)
                by Admin on {!!$created_at!!}<br>
                {!!$comment!!}<br>
            @endif
        @endforeach

        @if (Auth::user()->role === 1)
            <div class="page-login-form box">
                <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                    <div class = "form-group">
                        <div class="input-icon">
                            <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class = "btn btn-default login-btn">Post Comment</button>
                </form>
            </div>

        @elseif (Auth::user()->role === 2)
            @php
                $verifyCompanyId = DB::table('companies')->join('users',function ($join)
                {
                    $join->on('companies.userid','=','users.id')->where('companies.userid','=', Auth::user()->id);
                })->value('companies.companyid');
            @endphp
            @if($companyid === $verifyCompanyId)
                <div class="page-login-form box">
                    <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                        <div class = "form-group">
                            <div class="input-icon">
                                <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class = "btn btn-default login-btn">Post Comment</button>
                    </form>
                </div>
            @endif
        @elseif (Auth::user()->role === 3)
            <div class="page-login-form box">
                <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                    <div class = "form-group">
                        <div class="input-icon">
                            <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class = "btn btn-default login-btn">Post Comment</button>
                </form>
            </div>
        @endif
    </div>  
    @endif
</div>
@include('footer')
@stop


