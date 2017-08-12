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

Route::get('dashboard', function()
{
    if (Auth::check())
    {
        return view('dashboard');
    }

    else
    {
        return view('signin');
    }
});

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
Route::post('checksignup', 'UserController@storeUser');

Route::get('aboutus', function () 
{
    return view('aboutus');
});

Route::get('speakers', function () 
{
    return view('speakers');
});

Route::get('gallery', function () 
{
    return view('gallery');
});

Route::get('events', function () 
{
    return view('events');
});

Route::get('joinus', function () 
{
    return view('joinus');
});

Route::get('dashboard', function () 
{
    return view('dashboard');
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

Route::get('logout','UserController@logout');