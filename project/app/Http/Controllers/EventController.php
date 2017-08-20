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

class EventController extends Controller
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
    public function store(Request $request)
    {
        //
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

    public function viewLatestEvent ()
    {
        $event = DB::table('event')
            ->latest()
            ->first();
        return view('/viewlatestevent')->with('event',$event);
    }

    public function storeEvent (Request $request)
    {
        $name = $request->input('eventname');
        $date = $request->input('eventdate');
        $venue = $request->input('eventvenue');
        if ($request->input('fees') == "paid")
        {
            $fees = $request->input('feespaid');
        }
        else
        {
            $fees = $request->input('fees');
        }
        $image = $request->file('eventimage');
        $filename  = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/images/eventpic/' . $filename);
        Image::make($image->getRealPath())->resize(500, 550)->save($path);
        $newimage = '/images/eventpic/'.$filename;
        $description = $request->input('eventdescription');
        $userid = Auth::user()->id;
        $companyid = DB::table('companies')->join('users','users.id','=','companies.userid')->value('companies.id');
        $id = DB::table('events')->insertGetId(['eventName'=>$name, 'eventDate'=>$date, 'eventVenue'=>$venue, 'eventFees'=>$fees, 'eventimage'=>$newimage, 'eventDescription'=>$description,'companyid'=>$companyid]);
        return view('/viewevent')->with('id',$id);
    }
}
