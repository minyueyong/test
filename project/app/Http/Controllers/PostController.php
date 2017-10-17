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
}
