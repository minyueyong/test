@php
    $posttitle = DB::table('posts')->where('postid', $id)->value('postTitle');
    $userid = DB::table('posts')->where('postid', $id)->value('userid');
    $date = DB::table('posts')->where('postid',$id)->value('created_at');
    $role = DB::table('users')->where('id',$userid)->value('role');
    $created_at = DB::table('users')->where('id',$userid)->value('created_at'); 
    
    if ($role == 1)
    {
        $name = DB::table('students')->where('userid',$userid)->value('firstName');
        $image = DB::table('students')->where('userid',$userid)->value('image');
    }

    else if ($role == 2)
    {
        $name = DB::table('companies')->where('userid',$userid)->value('companyName');
        $image = DB::table('students')->where('userid',$userid)->value('image');
    }

    else if ($role == 3)
    {
        $name = "Admin";
        $image = "/images/userpic/admin.png";
    }     
    $postdescription = DB::table('posts')->where('postid',$id)->value('postDescription');   
@endphp

<title>{!!$posttitle!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>

<style>
    table
    {
        border:1px solid black;
        border-spacing: 10px;
        border-collapse: separate;
        width : 100%;
        table-layout:fixed;
    }
</style> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">{!!$posttitle!!}</h3>
    </div>

    <div>
        <table class="table-responsive" style ="background-color:#FFE2DC;" cellpadding=0 cellspacing=0>
        <tr>
            <td>
                by {!!$name!!} on {!!$date!!}
            </td>
            <td>
                <b> @php echo nl2br($postdescription); @endphp</b>
            </td>
        </tr>
        <tr>
            <td>
            <img src = "{!!$image!!}" alt="profilepic" class="img-rounded img-responsive"/>
            </td>
        </tr>

        </table>
    </div>

    <br>
    <div>
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
                    $image = DB::table('students')->where('userid',$userid)->value('image');
                }
                else if ($userrole == 2)
                {
                    $companyname = DB::table('companies')->where('userid',$userid)->value('companyName');
                    $image = DB::table('companies')->where('userid',$userid)->value('image');
                }
                else if ($userrole == 3)
                {
                    $image = "/images/userpic/admin.png";
                }
            @endphp
                    
            @if ($userrole == 1)
                <table class="table-responsive" cellpadding=0 cellspacing=0>
                    <tr>
                        <td>
                            by {!!$studentFName!!} on {!!$created_at!!}
                        </td>
                        <td>
                            <b>{!!$postcomment!!}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src = "{!!$image!!}" alt="profilepic" class="img-rounded img-responsive"/>
                        </td>
                    </tr>

                </table>
            @elseif ($userrole == 2)
                <table class="table-responsive" cellpadding=0 cellspacing=0>
                    <tr>
                        <td>
                            by {!!$companyname!!} on {!!$created_at!!}
                        </td>
                        <td>
                            {!!$postcomment!!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <img src = "{!!$image!!}" alt="profilepic" class="img-rounded img-responsive"/>
                        </td>
                    </tr>

                </table>

            @elseif ($userrole == 3)
                <table class="table-responsive" cellpadding=0 cellspacing=0>
                    <tr>
                        <td>
                             by Admin on {!!$created_at!!}
                        </td>
                        <td>
                            <b>{!!$postcomment!!}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src = "{!!$image!!}" alt="profilepic" class="img-rounded img-responsive"/>
                        </td>
                    </tr>
                </table>
            @endif
            <br>
        @endforeach
    </div>

    <br>
    <div class="page-login-form box">
        <form role="form" class="login-form" method="POST" action="/forum/{!!$id!!}/postcomment" enctype="multipart/form-data">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
                <div class = "form-group">
                    <div class="input-icon">
                        <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea style="width:85%;" rows="3" cols="60" maxlength="100" id="postcomment" name="postcomment" placeholder="Please comment here..."></textarea>
                    </div>
                </div>
                    
                <button type="submit" class = "btn btn-default login-btn" style="display:block,text-align=center;">Reply Post</button>
        </form>
    </div>
</div>

@include('footer')
@stop