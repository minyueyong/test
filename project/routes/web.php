<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () 
{
    return view('home');
});

Route::get('home', function () 
{
    return view('home');
});

Route::get('dashboard', 'UserController@showDashboard');

Route::get('signin', function () 
{
    if (Auth::check())
    {
        return redirect()->intended('/dashboard');
    }

    else
    {
        return view('/signin');
    }
});
Route::post('checksignin','UserController@signin');

Route::get('signup', function () 
{  
    if (Auth::check())
    {
        return redirect()->intended('/dashboard');
    }

    else
    {
        return view('signup');
    }
});

Route::get('studentsignup', function () 
{  
    if (Auth::check())
    {
        return redirect()->intended('/dashboard');
    }

    else
    {
        return view('studentsignup');
    }
});
Route::post('checkstudentsignup', 'UserController@storeStudentUser');

Route::get('companysignup', function () 
{  
    if (Auth::check())
    {
        return redirect()->intended('/dashboard');
    }

    else
    {
        return view('companysignup');
    }
});
Route::post('checkcompanysignup', 'UserController@storeCompanyUser');

Route::get('aboutus', function () 
{
    return view('aboutus');
});

Route::get('gallery', function () 
{
    return view('gallery');
});

Route::get('events', function () 
{
    return view('events');
});

Route::get('postevent', function () 
{
    if (Auth::check())
    {
        return view('/postevent');
    }

    else
    {
        return view('/signin');
    }
});
Route::post('viewevent', 'EventController@storeEvent');

Route::get('viewevent/{id}', function ($id) 
{
    return view('/viewevent')->with('id',$id);
});

Route::get('forum', function () 
{
    if (Auth::check())
    {
        return view('/forum');
    }

    else
    {
        return view('/signin');
    }
});

Route::get('logout','UserController@logout');