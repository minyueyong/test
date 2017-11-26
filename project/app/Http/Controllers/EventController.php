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
use Excel;
use Mail;
use App\Http\Controllers\Controller;
use PHPMailerAutoload; 
use PHPMailer;

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
            echo 'alert("The activity is waiting for admin approval!")';
            echo '</script>';
        }

        else
        {
            echo '<script language="javascript">';
            echo 'alert("Create only upcoming activities!")';
            echo '</script>';
        }
        $results = DB::table('companies')->join('users',function ($join)
        {
            $join->on('companies.userid','=','users.id')->where('companies.userid','=',Auth::user()->id);
        })->get();
        return view('/dashboard')->with('results',$results);
    }

    public function participateEvent($eventid)
    {
        if (Auth::check())
        {
            $eventSeats = DB::table('events')->where('eventid',$eventid)->value('eventSeats');
            $totalRegistered = DB::table('studentsnevents')->where('eventid',$eventid)->count('studentid');
            $currentDate = date('Y-m-d');
            $eventDate = DB::table('events')->where('eventid',$eventid)->value('eventDate');

            if(Auth::user()->role == 1 && $eventSeats > $totalRegistered)
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

            else if ((Auth::user()->role == 2 || Auth::user()->role == 3) && $eventDate == $currentDate)
            {
                $companyApproval = DB::table('companies')->where('userid',Auth::user()->id)->value('companyApproval');
                if ($companyApproval == 1)
                    return view('/markattendance')->with('eventid',$eventid);
                else
                    return redirect()->intended('viewevent/'.$eventid);
            }
            else
            {
                return redirect()->intended('viewevent/'.$eventid);
            }
        }
        else
        {
           return redirect()->intended('signin');
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
        $approval = $request->input('checkEvent');

        if ($approval == "Approve")
        {
            if(!empty($aEvent))
            {
                $N = count($aEvent);
                for ($i = 0; $i < $N; $i++)
                {
                    DB::table('events')->where('eventid',$aEvent[$i])->update(['eventApproval'=> 1]);
                }
            }
        }
        else if ($approval == "Deny")
        {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true); 
            $reason = $request->input('reason');

            if(!empty($aEvent))
            {
                $N = count($aEvent);
                for ($i = 0; $i < $N; $i++)
                {
                    $companyid = DB::table('events')->where('eventid',$aEvent[$i])->value('companyid');
                    $eventName = DB::table('events')->where('eventid',$aEvent[$i])->value('eventName');
                    $companyUserID = DB::table('companies')->where('companyid',$companyid)->value('userid');
                    $companyemail = DB::table('users')->where('id',$companyUserID)->value('email');
                    $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');

                    try 
                    {
                      $mail->isSMTP(); // tell to use smtp
                      $mail->CharSet = "utf-8"; // set charset to utf8
                      $mail->SMTPAuth = true;  // use smpt auth
                      $mail->SMTPSecure = "ssl"; // or ssl
                      $mail->Host = "smtp.sendgrid.net";
                      $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing. 
                      $mail->Username = "apikey";
                      $mail->Password = "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";
                      $mail->setFrom("monsta@gmail.com", "MONSTA Asia");
                      $mail->Subject = "Rejection of activity approval";
                      $mail->MsgHTML("Dear $companyName, <br><br>
                        Please note that your approval of upcoming activity, $eventName to be held has been rejected because of inappropriate activity $reason.  
                        <br>
                        Please feel free to contact us for more information regarding this matter. 
                        <br><br><br>
                        Yours sincerely, <br>
                        MONSTA
                        ");
                      $mail->addAddress($companyemail, $companyName);
                      $mail->send();
                      $mail->ClearAllRecipients();
                    } 
                    catch (phpmailerException $e) 
                    {
                      dd($e);
                    } 
                    catch (Exception $e) 
                    {
                      dd($e);
                    }
                    DB::table('events')->where('eventid',$aEvent[$i])->delete();
                }
            }
        }
        return redirect()->intended('/dashboard');
    }

    public function editEvent($eventid)
    {
        if(Auth::check())
        {
            if(Auth::user()->role === 2)
            {
                $companyid = DB::table('events')->where('eventid',$eventid)->value('companyid');
                $owncompanyid = DB::table('companies')->where('userid',Auth::user()->id)->value('companyid');
                if ($companyid == $owncompanyid)
                    return view('/editevent')->with('eventid',$eventid);
                else
                    return redirect()->intended('viewevent/'.$eventid);
            }
            else if (Auth::user()->role === 3)
            {
                return view('/editevent')->with('eventid',$eventid);
            }
            else
            {
                return redirect()->intended('viewevent/'.$eventid);
            }
        }
    }

    public function updateEvent(Request $request)
    {
        $eventid = $request->input('eventid');
        $name = $request->input('eventname');
        $date = $request->input('eventdate');
        $venue = $request->input('eventvenue');
    
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

        $mail = new PHPMailer\PHPMailer\PHPMailer(true); // notice the \  you have to use root namespace here
        $students = DB::table('studentsnevents')->where('eventid', $eventid)->pluck('studentid');

        foreach ($students as $student)
        {
            $studentUserID = DB::table('students')->where('studentid',$student)->value('userid');
            $studentFName = DB::table('students')->where('studentid',$student)->value('firstName');
            $studentEmail = DB::table('users')->where('id',$studentUserID)->value('email');
            $eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');
            $eventDate = DB::table('events')->where('eventid',$eventid)->value('eventDate');
            $eventVenue = DB::table('events')->where('eventid',$eventid)->value('eventVenue');
            $companyid = DB::table('events')->where('eventid',$eventid)->value('companyid');
            $companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
            $companyUserID = DB::table('companies')->where('companyid',$companyid)->value('userid');
            $companyemail = DB::table('users')->where('id',$companyUserID)->value('email');

            try 
            {
              $mail->isSMTP(); // tell to use smtp
              $mail->CharSet = "utf-8"; // set charset to utf8
              $mail->SMTPAuth = true;  // use smpt auth
              $mail->SMTPSecure = "ssl"; // or ssl
              $mail->Host = "smtp.sendgrid.net";
              $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing. 
              $mail->Username = "apikey";
              $mail->Password = "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";
              $mail->setFrom($companyemail, $companyName);
              $mail->Subject = "Notification of Changing Activity Details";
              $mail->MsgHTML("Dear $studentFName, <br><br>
                Please note that the details for our upcoming activity $eventName, to be held on $eventDate.<br><br>
                Due to unforeseen circumstances, it has become necessary for us to change our details. We apologize for any inconvenience this may cause. <br><br>
                The activity will now be held at: $eventVenue.
                <br><br><br>
                Yours sincerely, <br>
                $companyName
                ");

              $mail->addAddress($studentEmail, $studentFName);
              $mail->send();
              $mail->ClearAllRecipients();
            } 
            catch (phpmailerException $e) 
            {
              dd($e);
            } 
            catch (Exception $e) 
            {
              dd($e);
            }
        }

        try 
        {
          $mail->isSMTP(); // tell to use smtp
          $mail->CharSet = "utf-8"; // set charset to utf8
          $mail->SMTPAuth = true;  // use smpt auth
          $mail->SMTPSecure = "ssl"; // or ssl
          $mail->Host = "smtp.sendgrid.net";
          $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing. 
          $mail->Username = "apikey";
          $mail->Password = "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";
          $mail->setFrom($companyemail, $companyName);
          $mail->Subject = "Notification of Changing Activity Details";
          $mail->MsgHTML("Dear Admin, <br><br>
            Please note that the details for our upcoming activity, $eventName to be held on $eventDate.<br><br>
            Due to unforeseen circumstances, it has become necessary for us to change our details. We apologize for any inconvenience this may cause. <br><br>
            The activity will now be held at: $eventVenue.
            <br><br><br>
            Yours sincerely,<br> 
            $companyName
            ");

          $mail->addAddress("evonmiyako.em@gmail.com", "Admin");
          $mail->send();
        } 
        catch (phpmailerException $e) 
        {
          dd($e);
        } 
        catch (Exception $e) 
        {
          dd($e);
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
                    $pdf::cell(25,8,"First Name",1,"","C");
                    $pdf::cell(25,8,"Last Name",1,"","C");
                    $pdf::cell(55,8,"Email",1,"","C");
                    $pdf::cell(25,8,"Phone",1,"","C");
                    $pdf::cell(25,8,"Campus",1,"","C");
                    $pdf::cell(35,8,"Education",1,"","C");
                    $pdf::Ln();

                    foreach($students as $student)
                    {
                        $studentFirstName = DB::table('students')->where('studentid', $student)->value('firstName');
                        $studentLastName = DB::table('students')->where('studentid', $student)->value('lastName');
                        $studentUserId = DB::table('students')->where('studentid', $student)->value('userid');
                        $studentEmail = DB::table('users')->where('id',$studentUserId)->value('email');
                        $studentPhone = DB::table('students')->where('studentid',$student)->value('phone');
                        $studentCampus = DB::table('students')->where('studentid',$student)->value('campus');
                        $studentEducation = DB::table('students')->where('studentid',$student)->value('education');

                        $pdf::SetFont("Arial","",10);
                        $pdf::cell(25,8,$studentFirstName,1,"","C");
                        $pdf::cell(25,8,$studentLastName,1,"","C");
                        $pdf::cell(55,8,$studentEmail,1,"","C");
                        $pdf::cell(25,8,"+60".$studentPhone,1,"","C");
                        $pdf::cell(25,8,$studentCampus,1,"","C");
                        $pdf::cell(35,8,$studentEducation,1,"","C");
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

    public function exportexcel($eventid) 
    {
        // Execute the query used to retrieve the data. In this example
        // we're joining hypothetical users and payments tables, retrieving
        // the payments table's primary key, the user's first and last name, 
        // the user's e-mail address, the amount paid, and the payment
        // timestamp.
        if (Auth::check())
        {
            if (Auth::user()->role == 2 || Auth::user()->role == 3)
            {
                $companyApproval = DB::table('companies')->where('userid',Auth::user()->id)->value('companyApproval');
                if ($companyApproval == 1 || Auth::user()->role == 3) 
                {
                    $eventName = DB::table('events')->where('eventid',$eventid)->value('eventName');
                    $eventdetails= DB::table('studentsnevents')
                        ->join('students', 'students.studentid', '=', 'studentsnevents.studentid')
                        ->join('events', 'events.eventid', '=', 'studentsnevents.eventid')
                        ->join('users', 'users.id', '=' ,'studentsnevents.eventid')
                        ->where('studentsnevents.eventid', '=', $eventid)
                        ->select('students.firstName', 'students.lastName', 'users.email', 'students.phone','students.campus','students.education')
                        ->get();
    
                    // Initialize the array which will be passed into the Excel
                    // generator.
                    $eventArray = []; 
                
                    // Define the Excel spreadsheet headers
                    $eventArray[] = ['First Name', 'Last Name','Email','Phone','Campus', 'Education'];
        
                    // Convert each member of the returned collection into an array,
                    // and append it to the payments array.
                    foreach ($eventdetails as $eventdetail) 
                    {
                        $eventArray[] = (array)$eventdetail;
                    }
        
                    // Generate and return the spreadsheet
                    Excel::create($eventName, function($excel) use ($eventArray) 
                    {
                        // Set the spreadsheet title, creator, and description
                        $excel->setTitle("Event Details");
                        $excel->setCreator('Monsta')->setCompany('Monsta');
                        $excel->setDescription("Event Details");
                
                        // Build the spreadsheet, passing in the payments array
                        $excel->sheet('sheet1', function($sheet) use ($eventArray) 
                        {
                            $sheet->fromArray($eventArray, null, 'A1', false, false);
                        });
                
                    })->download('xlsx');
                }
            }
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

    public function checkInterest(Request $request)
    {
        $interest = $request->input('interestdropdown');
        return view('/newevents')->with('interest', $interest);
    }
}
