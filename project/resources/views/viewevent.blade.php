@php 
    $name = DB::table('events')->where('eventid', $id)->value('eventName');
    $date = DB::table('events')->where('eventid', $id)->value('eventDate');
    $venue = DB::table('events')->where('eventid', $id)->value('eventVenue');
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
<style>
    .containerfluid1
    {
        padding: 80px;
        margin-left : 3cm;
    }

    .row-offcanvas-right
    {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 5px solid #f00;
        margin: 10px;
    }
</style>

<div class = "containerfluid1">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="table-responsive col-xs-4 col-sm-9">
            <table class="table table-condensed table-bordered" >
                <br>
                    <div class="row" >
                        <div class="col-xs-6 col-sm-6">
                            <div>
                                <img src = "{!!$image!!}" alt="eventpic" class="img-square img-responsive" style="max-width:100%;height:auto;"/>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6"style="padding-top:50px;" >
                            <div style="font-size:20px">
                                <div><b>Name:</b> {!!$name!!} </div>
                                <div><b>Organizer: </b>{!!$companyName!!} </div>
                                <div><b>Date:</b> {!!$date!!}</div>
                                <div><b>Venue: </b>{!!$venue!!} </div>
                                <div><b>Fees:</b> {!!$fees!!} </div>
                                <div><b>Description: </b> <br>@php echo nl2br($description); @endphp </div>
                                <div><b>Total Student: </b>{!!$totalRegistered!!} </div>
                                <br>

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
                                
                                    <div class= "row">
                                    </div>
                            </div>        
                        </div> 
                    </div>
                                
                    <div class= "row" style="margin-left:1cm;">
                        <h3 class = "text-uppercase" style="margin-left:1cm;">Comment Section</h3>
                    
                        @if (Auth::user()->role === 1)
                            <div class="page-login-form box">
                                <form role="form" class="login-form" method="POST" action="/viewevent/{!!$id!!}/postcomment" enctype="multipart/form-data">
                                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                                    <div class = "form-group">
                                        <div class="input-icon">
                                            <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="comment" name="comment" placeholder="Please comment here..."></textarea>
                                        </div>
                                    </div>
                    
                                    <button type="submit" class = "btn btn-default login-btn" style="margin-left:2.5cm;display:block">Post Comment</button>
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
                    
                                        <button type="submit" class = "btn btn-default login-btn" style="margin-left:2.5cm;display:block">Post Comment</button>
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
                    
                                        <button type="submit" class = "btn btn-default login-btn" style="margin-left=2.5cm;display:block">Post Comment</button>
                                </form>
                            </div>
                        @endif
                        <br><br>
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
                    </div>
                    @endif
            </table>
        </div>
    </div>
</div>
@include('footer')
@stop