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
    public function storeUser(Request $request)
    {
            $user = new User;
            $user->firstName = $request->input('firstName');
            $user->lastName = $request->input('lastName');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->dob = $request->input('dob');
            $user->phone = $request->input('phone');
            $user->campus = $request->input('campus');
            $user->gender = $request->input('gender');
            $user->education = $request->input('education');
            $user->interest = $request->input('interest');
            $user->aboutme = $request->input('aboutme');
            $image = $request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/userpic/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $user->image = '/images/userpic/'.$filename;
            $user->save();
            Auth::login($user);
            return redirect()->intended('/dashboard');
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
