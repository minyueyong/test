@php 
    $name = DB::table('events')->where('eventid', $id)->value('eventName');
    $date = DB::table('events')->where('eventid', $id)->value('eventDate');
    $venue = DB::table('events')->where('eventid', $id)->value('eventVenue');
    $fees = DB::table('events')->where('eventid',$id)->value('eventFees');
    $seats = DB::table('events')->where('eventid', $id)->value('eventSeats');
    $interest = DB::table('events')->where('eventid',$id)->value('eventInterest');
    $image = DB::table('events')->where('eventid', $id)->value('eventImage');
    $description = DB::table('events')->where('eventid', $id)->value('eventDescription');
    $companyid = DB::table('events')->where('eventid', $id)->value('companyid');
    $totalRegistered = DB::table('studentsnevents')->where('eventid',$id)->count('studentid');
    $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
    $currentDate = date('Y-m-d');
@endphp

<title>{!!$name!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 
<style>
    #row
    {
        margin-left: 0.5px;
    }   

    #by
    {
        color: salmon; 
        margin-left: 1cm;
    }

    #commentsection
    {
        margin-left:1.3cm;
    }

    #commentPost
    {
        margin-left: 1cm;
    }

    #commentbutton
    {
        margin-left:2.5cm;
    }

    .img-thumbnail
    {
        width: 65%;
        height: 25%;
        margin: auto;
    }

    /* Smartphones (portrait) ----------- */
    @media only screen and (max-width : 480px)
    {
        #eventdetails
        {
            margin-left: 1cm;
        }

        #relatedactivity
        {
            margin-left: 1cm;
        }

        #eventimageheader
        {
            padding-top: 50px;
        }
    }

    /* Laptop ----------- */
    @media only screen and (min-width: 1024px)
    {
         .containerfluid1
        {
            padding: 60px;
            margin-left : 1cm;
        }

        .row-offcanvas-right
        {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            /* border: 5px solid #f00; */
            margin: 10px;
        }

        #by
        {
            font-size: 1.2vw; 
        }

        #eventimage1
        {
            width: 500px;
        }

        #eventimage2
        {
            width: 200px;
            height: 200px;
        }

        .img-thumbnail
        {
            width: 55%;
            height: 35%;
            margin: auto;
        }   

        #relatedactivity
        {
            margin-left:5cm;
        }
    }
</style>

<div class = "containerfluid1">
    <div class="row row-offcanvas row-offcanvas-right">
        <div>
            <br>
                <div class="row">
                    <div class="col-sm-4" id="eventimageheader">
                        <div>
                            <img id="eventimage1" src = "{!!$image!!}" alt="eventpic" class="img-square img-responsive"/>
                        </div>
                            
                        <br>
                        <div>
                            @php 
                                $commentsid = DB::table('usersneventsncomments')->where('eventid',$id)->pluck('commentid');
                            @endphp                        
                            @if (count($commentsid) != 0)
                                <h3 class = "text-uppercase" id="commentsection"><u>Comment Section</u></h3>
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
                                        <b><div id = "by">by {!!$studentFName!!} on {!!$created_at!!}</div>
                                        <div id = "commentPost">{!!$comment!!}</div></b>
                                    @elseif ($userrole == 2)
                                        <b><div id = "by">by {!!$companyname!!} on {!!$created_at!!}</div>
                                        <div id = "commentPost">{!!$comment!!}</div></b>
                                    @elseif ($userrole == 3)
                                        <b><div id = "by">by Admin on {!!$created_at!!}</div>
                                        <div id = "commentPost">{!!$comment!!}</div></b>
                                    @endif
                                    <br>
                                @endforeach
                            @else
                                <h3 class = "text-uppercase" id="commentsection"><u>Comment Section</u></h3>
                            @endif

                            @if (Auth::check())
                                @if (Auth::user()->role === 1)
                                    <div class="page-login-form box">
                                        <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                                            <div class = "form-group">
                                                <div class="input-icon">
                                                    <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> 
                                                    <textarea style="width:85%;" rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                                                </div>
                                            </div>
                                
                                            <button type="submit" class = "btn btn-default login-btn" id="commentbutton" style="display:block">Post Comment</button>
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
                                                        <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> 
                                                        <textarea style="width:85%;" rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                                                    </div>
                                                </div>
                                
                                                <button type="submit" class = "btn btn-default login-btn" id="commentbutton" style="display:block">Post Comment</button>
                                            </form>
                                        </div>
                                    @endif
                                @elseif (Auth::user()->role === 3)
                                    <div class="page-login-form box">
                                        <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                                                <div class = "form-group">
                                                    <div class="input-icon">
                                                        <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> 
                                                            <textarea style="width:85%;" rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                                                    </div>
                                                </div>
                                
                                                <button type="submit" class = "btn btn-default login-btn" id="commentbutton" style="display:block">Post Comment</button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3" style="padding-top:5px;">
                        <div style="font-size:20px" id="eventdetails">
                            <div><b>Name:</b> {!!$name!!} </div>
                            <div><b>Organizer: </b><a id = "companydashboard" href="{{ url('dashboard/'.$companyid) }}">{!!$companyName!!}</a></div>
                            <div><b>Date:</b> {!!$date!!}</div>
                            <div><b>Venue: </b>{!!$venue!!} </div>
                            <div><b>Fees:</b> {!!$fees!!} </div>
                            <div><b>Interest:</b> {!!$interest!!}</div>
                            <div><b>Description: </b> <br>@php echo nl2br($description); @endphp </div>
                            <div><b>Seats Left: </b>{!!$seats - $totalRegistered!!}</div>
                            <br>

                            @if(Auth::check())
                                @if($date > $currentDate)
                                    @if(Auth::user()->role === 1 && $seats > $totalRegistered)
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
                                @else
                                    <a href="/viewevent/{!!$id!!}/participateevent" class = "btn btn-default login-btn">Participate It!</a>
                                @endif
                        </div>
                        <br>    
                    </div> 

                    <div class= "row">
                        <div class="col-sm-3" id="relatedactivity">
                            <div>
                                <p style = "font-size:20px; color:red; margin-left:0.5cm;"><u><b> Related Activities</b></u></p>
                                @php
                                    $relatedUpcomingEventsID = DB::table('events')->pluck('eventid');
                                @endphp

                                @foreach($relatedUpcomingEventsID as $relatedUpcomingEventID)
                                    @php
                                        $relatedDate = DB::table('events')->where('eventid', $relatedUpcomingEventID)->value('eventDate');
                                    @endphp
                                    
                                    @if ($relatedDate > $currentDate && $relatedUpcomingEventID != $id)
                                        @php
                                            $relatedEventImage = DB::table('events')->where('eventid', $relatedUpcomingEventID)->value('eventImage');
                                        @endphp
                                        <a href="{{ url('viewevent/'.$relatedUpcomingEventID) }}" id="thumbnail">
                                            <img id="eventimage2" src = "{!!$relatedEventImage!!}" alt="eventpic" class="img-square img-responsive img-thumbnail"/>
                                        </a>
                                        <br>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                        </div>                    
                    </div>
                </div>
        </div>
    </div>
</div>
@include('footer')
@stop