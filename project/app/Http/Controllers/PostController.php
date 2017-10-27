<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function storePost (Request $request)
    {
    	$title = $request->input('posttitle');
    	$description = $request->input('postdescription');
    	DB::table('posts')->insertGetId(['postTitle'=>$title,'postDescription'=>$description, 'userid'=>Auth::user()->id]);
        return redirect()->intended('/forum');
    }

    public function postComment(Request $request, $postid)
    {
        $postcomment = $request->input('postcomment');
        $postcommentid = DB::table('postcomments')->insertGetId(['postcomment'=>$postcomment, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        $userid = Auth::user()->id;
        DB::table('usersnpostsncomments')->insert(['userid'=>$userid,'postid'=>$postid,'postcommentid'=>$postcommentid]); 
        return redirect()->intended('forum/'.$postid);       
    }

    public function viewForum()
    {
        if (Auth::check())
        {
            if(Auth::user()->role == 2)
            {
                $companyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
                $companyApproval = DB::table('companies')->where('companyid',$companyid)->value('companyApproval');
                if($companyApproval == 1)
                    return view('/forum');
                else
                    return redirect()->intended('/dashboard');
            }
            else
            {
                return view('/forum');
            }
        }
        else
        {
            return redirect()->intended('/signin');
        }
    }

    public function createPost()
    {
        if (Auth::check())
        {
            if(Auth::user()->role == 2)
            {
                $companyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
                $companyApproval = DB::table('companies')->where('companyid',$companyid)->value('companyApproval');
                if($companyApproval == 1)
                    return view('/createpost');
                else
                    return redirect()->intended('/dashboard');
            }
            else
            {
                return view('/createpost');
            }
        }
        else
        {
            return redirect()->intended('/signin');
        }
    }

    public function viewPost($id)
    {
        if (Auth::check())
        {
            if(Auth::user()->role == 2)
            {
                $companyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
                $companyApproval = DB::table('companies')->where('companyid',$companyid)->value('companyApproval');
                if($companyApproval == 1)
                    return view('/viewpost')->with('id',$id);
                else
                    return redirect()->intended('/dashboard');
            }
            else
            {
                return view('/viewpost')->with('id',$id);
            }
        }
        else
        {
            return redirect()->intended('/signin');
        }
    }
}
