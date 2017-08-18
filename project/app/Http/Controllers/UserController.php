<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudentUser(Request $request)
    {
            $user = new User;
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $dob = $request->input('dob');
            $phone = $request->input('phone');
            
            if ($request->input('campus') == "other")
            {
                $campus = $request->input('OtherCampus');
            }
            else
            {
                $campus = $request->input('campus');
            }

            $gender = $request->input('gender');

            if ($request->input('education') == "other")
            {
                $education = $request->input('OtherEducation');
            }
            else
            {
                $education = $request->input('education');
            }
            
            if ($request->input('interest') == "other")
            {
                $interest = $request->input('OtherInterest');
            }
            else
            {
                $interest = $request->input('interest');
            }
            
            $aboutme = $request->input('aboutme');
            $image = $request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/userpic/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $imageName = '/images/userpic/'.$filename;

            $user->role = 1;
            $user->save();
            Auth::login($user);
            $userid = Auth::user()->id;

            DB::table('students')->insertGetId(['firstName'=>$firstName,'lastName'=>$lastName,'dob'=>$dob,'phone'=>$phone,'campus'=>$campus,'gender'=>$gender,'education'=>$education,'interest'=>$interest,'image'=>$imageName,'aboutme'=>$aboutme,'userid'=>$userid]);
            
            return redirect()->intended('/dashboard');
    }

    public function storeCompanyUser(Request $request)
    {
            $user = new User;
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            $companyName = $request->input('companyName');
            $phone = $request->input('phone');
            $aboutcompany = $request->input('aboutcompany');
            if ($request->input('interest') == "other")
            {
                $interest = $request->input('OtherInterest');
            }
            else
            {
                $interest = $request->input('interest');
            }

            $image = $request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/userpic/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $imageName = '/images/userpic/'.$filename;

            $user->role = 2;
            $user->save();
            Auth::login($user);
            $userid = Auth::user()->id;
            
            DB::table('companies')->insertGetId(['companyName'=>$companyName,'phone'=>$phone,'aboutcompany'=>$aboutcompany,'interest'=>$interest,'image'=>$imageName,'userid'=>$userid]);

            return redirect()->intended('/dashboard');
    }

    public function showDashboard(Request $request)
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 1)
            {
                $results = DB::table('students')->join('users','students.userid','=','users.id')->get();
                return view('/dashboard')->with('results',$results);
            }

            else if (Auth::user()->role == 2)
            {
                $results = DB::table('companies')->join('users','companies.userid','=','users.id')->get();
                return view('/dashboard')->with('results',$results);
            }
        }

        else
        {
            return view('/signin');
        }
    }

    public function signin(Request $request)
    {
        $email = $request->input('useremail');
        $password = $request->input('userpw');
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('/dashboard');
        }

        else
        {
            return view('/signin');
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->intended('/signin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
