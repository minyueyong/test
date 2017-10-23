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
    return view('landingpage');
});

Route::get('home', function () 
{
    return view('landingpage');
});

Route::get('dashboard', 'UserController@showDashboard');

Route::get('totalstudentsdetails','UserController@totalStudentsDetails');
Route::get('totalcompaniesdetails','UserController@totalCompaniesDetails');
Route::get('totaleventsdetails','UserController@totalEventsDetails');

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
Route::post('/checkcompanyapproval','UserController@checkCompanyApproval');

Route::get('aboutus', function () 
{
    return view('aboutus');
});

Route::get('gallery', function () 
{
    return view('gallery');
});
Route::get('gallery/{id}', function ($id) 
{
    return view('/pastphotos')->with('id',$id);
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
Route::post('/checkeventapproval','EventController@checkEventApproval');

Route::get('viewevent/{id}', function ($id) 
{
    return view('/viewevent')->with('id',$id);
});

Route::get('viewevent/{id}/participateevent','EventController@participateEvent');
Route::get('/viewevent/{id}/participantdetails','EventController@participantDetails');

Route::post('/checkstudentattendance','EventController@checkStudentAttendance');

Route::get('/viewevent/{id}/editevent','EventController@editEvent');
Route::post('/updateevent','EventController@updateEvent');

Route::post('/viewevent/{id}/postcomment','EventController@postComment');

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

Route::get('forum/createpost',function()
{
    if (Auth::check())
    {
        return view('/createpost');
    }

    else
    {
        return view('/signin');
    }
});
Route::post('storepost', 'PostController@storePost');

Route::get('forum/{id}', function ($id) 
{
    return view('/viewpost')->with('id',$id);
});
Route::post('/forum/{id}/postcomment','PostController@postComment');

Route::get('logout','UserController@logout');