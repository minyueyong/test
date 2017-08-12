<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('/viewLatestEvent')->with('event',$event);
    }

    public function storeEvent (Request $request)
    {
        $name = $request->input('eventname');
        $date = $request->input('eventdate');
        $venue = $request->input('eventvenue');
        $image = $request->file('eventimage');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/eventpic/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $newimage = '/images/eventpic/'.$filename;
        $description = $request->input('eventdescription');
        $id = DB::table('events')->insertGetId(['eventname'=>$name, 'eventdate'=>$date, 'eventvenue'=>$venue, 'eventimage'=>$newimage, 'eventdescription'=>$description]);
        return view('/viewEvent');
    }
}
