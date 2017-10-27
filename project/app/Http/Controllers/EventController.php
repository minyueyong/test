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
use Fpdf;

class EventController extends Controller
{
    public function storeEvent (Request $request)
    {
        $name = $request->input('eventname');
        $currentDate = date('Y-m-d');
        $date = $request->input('eventdate');

        if($date > $currentDate)
        {
            $venue = $request->input('eventvenue');
            if ($request->input('interest') == "other")
            {
                $interest = $request->input('OtherInterest');
            }
            else
            {
                $interest = $request->input('interest');
            }
            
            $seats = $request->input('eventseats');

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
            $companyid = DB::table('companies')->join('users',function ($join)
            {
                $join->on('companies.userid','=','users.id')->where('companies.userid','=', Auth::user()->id);
            })->value('companies.companyid');
            $id = DB::table('events')->insertGetId(['eventName'=>$name, 'eventDate'=>$date, 'eventVenue'=>$venue, 'eventInterest'=>$interest, 'eventSeats'=>$seats, 'eventFees'=>$fees, 'eventimage'=>$newimage, 'eventDescription'=>$description,'companyid'=>$companyid]);
            echo '<script language="javascript">';
            echo 'alert("The event is waiting for admin approval!")';
            echo '</script>';
        }

        else
        {
            echo '<script language="javascript">';
            echo 'alert("Create only upcoming events!")';
            echo '</script>';
        }
        return view('/landingpage');
    }

    public function participateEvent($eventid)
    {
        if(Auth::user()->role == 1)
        {
            $studentid = DB::table('students')->join('users',function ($join)
            {
                    $join->on('students.userid','=','users.id')->where('students.userid','=', Auth::user()->id);
            })->value('students.studentid');

            $studentParticipate = DB::table('studentsnevents')->where('studentid',$studentid)->where(DB::raw('eventid'), $eventid)->count();
            
            if ($studentParticipate == 0)
            {
                $id = DB::table('studentsnevents')->insert(['studentid'=>$studentid, 'eventid'=>$eventid]);
            }
            return redirect()->intended('/dashboard');
        }

        else if (Auth::user()->role == 2)
        {
            $companyApproval = DB::table('companies')->where('userid',Auth::user()->id)->value('companyApproval');
            if ($companyApproval == 1)
                return view('/markattendance')->with('eventid',$eventid);
            else
                return redirect()->intended('/dashboard');
        }
    }

    public function checkStudentAttendance(Request $request)
    {
        $aStudent = $request->input('student');
        $eventid = $request->input('eventid');

        if(!empty($aStudent))
        {
            $N = count($aStudent);
            for ($i = 0; $i < $N; $i++)
            {
                $experience = DB::table('students')->where('studentid',$aStudent[$i])->value('experience') + 100;
                DB::table('students')->where('studentid',$aStudent[$i])->update(['experience'=> $experience]);
                $currentExperience = DB::table('students')->where('studentid',$aStudent[$i])->value('experience');
                if ($currentExperience >= 2000)
                {
                    DB::table('students')->where('studentid',$aStudent[$i])->update(['status'=> "Verified"]);
                }
                else if ($currentExperience >= 3000)
                {
                    DB::table('students')->where('studentid',$aStudent[$i])->update(['status'=> "Star"]);
                }
                DB::table('studentsnevents')->where('studentid',$aStudent[$i])->where(DB::raw('eventid'), $eventid)->update(['participate'=> 1]);
            }
        }
       return view('/markattendance')->with('eventid',$eventid);
    }

    public function participantDetails($eventid)
    {
        if (Auth::check())
        {
            if(Auth::user()->role === 2)
            {
                return view('/participantdetails')->with('eventid',$eventid);
            }

            else if(Auth::user()->role === 3)
            {
                return view('/participantdetails')->with('eventid',$eventid);
            }

            else
            {
                return redirect()->intended('viewevent/'.$eventid);
            }
        }
        else
        {
            return redirect()->intended('viewevent/'.$eventid);
        }
    }

    public function checkEventApproval(Request $request)
    {
        $aEvent = $request->input('event');

        if(!empty($aEvent))
        {
            $N = count($aEvent);
            for ($i = 0; $i < $N; $i++)
            {
                DB::table('events')->where('eventid',$aEvent[$i])->update(['eventApproval'=> 1]);
            }
        }
       return view('/dashboard');
    }

    public function editEvent($eventid)
    {
        if(Auth::user()->role === 2)
        {
            return view('/editevent')->with('eventid',$eventid);
        }
    }

    public function updateEvent(Request $request)
    {
        $eventid = $request->input('eventid');
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
        $description = $request->input('eventdescription');
        $image = $request->file('eventimage');

        if (!empty($name))
        {           
            $eventname = $name;
            DB::table('events')->where('eventid',$eventid)->update(['eventName'=> $eventname]);
        }

        if (!empty($date))
        {           
            $eventdate = $date;
            DB::table('events')->where('eventid',$eventid)->update(['eventDate'=> $eventdate]);
        }

        if (!empty($venue))
        {           
            $eventvenue = $venue;
            DB::table('events')->where('eventid',$eventid)->update(['eventVenue'=> $eventvenue]);
        }

        if (!empty($fees))
        {           
            $eventfees = $fees;
            DB::table('events')->where('eventid',$eventid)->update(['eventFees'=> $eventfees]);
        }

        if (!empty($description))
        {           
            $eventdescription = $description;
            DB::table('events')->where('eventid',$eventid)->update(['eventDescription'=> $eventdescription]);
        }

        if (!empty($image))
        {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/eventpic/' . $filename);
            Image::make($image->getRealPath())->resize(500, 550)->save($path);
            $newimage = '/images/eventpic/'.$filename;
            DB::table('events')->where('eventid',$eventid)->update(['eventImage'=> $newimage]);
        }
        return redirect()->intended('viewevent/'.$eventid);
    }

    public function postComment(Request $request, $eventid)
    {
        $comment = $request->input('comment');
        $commentid = DB::table('comments')->insertGetId(['comment'=>$comment, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        $userid = Auth::user()->id;
        DB::table('usersneventsncomments')->insert(['userid'=>$userid,'eventid'=>$eventid,'commentid'=>$commentid]); 
        return redirect()->intended('viewevent/'.$eventid);       
    }

    public function exportPdf($eventid)
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 2 || Auth::user()->role == 3)
            {
                $companyApproval = DB::table('companies')->where('userid',Auth::user()->id)->value('companyApproval');
                if($companyApproval == 1 || Auth::user()->role == 3)
                {
                    $students = DB::table('studentsnevents')->where('eventid', $eventid)->pluck('studentid');
                    $eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');

                    $pdf = new Fpdf();
                    $pdf::AddPage();
                    $pdf::SetFont('Arial','B',18);
                    $pdf::Cell(0,10,"Participant Details of ".$eventName,0,"","C");
                    $pdf::Ln();
                    $pdf::Ln();
                    $pdf::SetFont('Arial','B',12);
                    $pdf::cell(35,8,"First Name",1,"","C");
                    $pdf::cell(35,8,"Last Name",1,"","C");
                    $pdf::cell(65,8,"Email",1,"","C");
                    $pdf::cell(55,8,"Phone",1,"","C");
                    $pdf::Ln();

                    foreach($students as $student)
                    {
                        $studentFirstName = DB::table('students')->where('studentid', $student)->value('firstName');
                        $studentLastName = DB::table('students')->where('studentid', $student)->value('lastName');
                        $studentUserId = DB::table('students')->where('studentid', $student)->value('userid');
                        $studentEmail = DB::table('users')->where('id',$studentUserId)->value('email');
                        $studentPhone = DB::table('students')->where('studentid',$student)->value('phone');

                        $pdf::SetFont("Arial","",10);
                        $pdf::cell(35,8,$studentFirstName,1,"","C");
                        $pdf::cell(35,8,$studentLastName,1,"","C");
                        $pdf::cell(65,8,$studentEmail,1,"","C");
                        $pdf::cell(55,8,"+60".$studentPhone,1,"","C");
                        $pdf::Ln();
                    }
                    $pdf::Output($eventName.".pdf",'D');
                    exit;
                }
            }
        }
        else
        {
            return redirect()->intended('viewevent/'.$eventid);
        }
    }

    public function showCompany($companyid)
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 2)
            {
                $owncompanyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
                if ($owncompanyid == $companyid)
                    return redirect()->intended('dashboard');
            }
        }
        return view('/companydashboard')->with('companyid',$companyid);
    }
}
