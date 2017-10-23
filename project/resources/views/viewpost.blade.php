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

<style>
    table
    {
        border:1px solid black;
        border-spacing: 10px;
        border-collapse: separate;
    }
</style> 

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">{!!$posttitle!!}</h3>
    </div>

    <div align="center">
        <table width="400" style ="background-color:#FFA07A;">
            <tr>
                <td>
                    by <b>{!!$name!!}</b>
                    on {!!$date!!}
                </td>
            </tr>

            <tr>
                <td>
                    <b>@php echo nl2br($postdescription); @endphp</b>
                </td>
            </tr>
        </table>
    </div>

    <br>
    <div align="center">
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
                <table width="400">
                    <tr>
                        <td>
                         by <b>{!!$studentFName!!}</b> on <b>{!!$created_at!!}</b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>{!!$postcomment!!}</b>
                        </td>
                    </tr>
                </table>
            @elseif ($userrole == 2)
                <table width="400">
                    <tr>
                        <td>
                            by <b>{!!$companyname!!}</b> on <b>{!!$created_at!!}</b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>{!!$postcomment!!}</b>
                        </td>
                    </tr>
                </table>

            @elseif ($userrole == 3)
                <table width="400">
                    <tr>
                        <td>
                            by <b>Admin</b> on <b>{!!$created_at!!}</b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>{!!$postcomment!!}</b>
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
                        <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="postcomment" name="postcomment" placeholder="Please comment here..."></textarea>
                    </div>
                </div>
                    
                <button type="submit" class = "btn btn-default login-btn" style="display:block,text-align=center;">Reply Post</button>
        </form>
    </div>
</div>

@include('footer')
@stop