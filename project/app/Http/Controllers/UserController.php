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
use Carbon\Carbon;

class UserController extends Controller
{
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

        DB::table('students')->insertGetId(['firstName'=>$firstName,'lastName'=>$lastName,'dob'=>$dob,'phone'=>$phone,'campus'=>$campus,'gender'=>$gender,'education'=>$education,'interest'=>$interest,'image'=>$imageName,'aboutme'=>$aboutme,'status'=>"Newbie",'experience'=>1000,'userid'=>$userid]);
            
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

        $status = "Basic";

        if ($status == "Basic")
            $membershipDate = Carbon::now()->addMonths(1);
        else if ($status == "Popular")
            $membershipDate = Carbon::now()->addMonths(3);
        else if ($status == "Epic")
            $membershipDate = Carbon::now()->addMonths(6);
        $image = $request->file('image');
        $filename  = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/images/userpic/' . $filename);
        Image::make($image->getRealPath())->resize(150, 150)->save($path);
        $imageName = '/images/userpic/'.$filename;

        $user->role = 2;
        $user->save();
        Auth::login($user);
        $userid = Auth::user()->id;
            
        DB::table('companies')->insertGetId(['companyName'=>$companyName,'phone'=>$phone,'aboutcompany'=>$aboutcompany,'interest'=>$interest, 'status'=>$status, 'membershipDate'=>$membershipDate ,'image'=>$imageName,'userid'=>$userid]);

        return redirect()->intended('/dashboard');
    }

    public function showDashboard(Request $request)
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 1)
            {
                $results = DB::table('students')->join('users',function ($join)
                {
                    $join->on('students.userid','=','users.id')->where('students.userid','=',Auth::user()->id);
                })->get();
                return view('/dashboard')->with('results',$results);
            }
            
            else if (Auth::user()->role == 2)
            {
                $results = DB::table('companies')->join('users',function ($join)
                {
                    $join->on('companies.userid','=','users.id')->where('companies.userid','=',Auth::user()->id);
                })->get();
                return view('/dashboard')->with('results',$results);
            }

            else if (Auth::user()->role == 3)
            {
                return view('/dashboard');
            }
        }

        else
        {
            return view('/signin');
        }
    }

    public function checkCompanyApproval(Request $request)
    {
        $aCompany = $request->input('company');

        if(!empty($aCompany))
        {
            $N = count($aCompany);
            for ($i = 0; $i < $N; $i++)
            {
                DB::table('companies')->where('companyid',$aCompany[$i])->update(['companyApproval'=> 1]);
            }
        }
       return view('/dashboard');
    }

    public function signin(Request $request)
    {
        $email = $request->input('useremail');
        $password = $request->input('userpw');
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            if (Auth::user()->role == 1 || Auth::user()->role == 3)
            {
                return redirect()->intended('/dashboard');
            }
            else if (Auth::user()->role == 2)
            {
                $membershipDate = DB::table('companies')->where('userid',Auth::user()->id)->value('membershipDate');
                $currentDate = date('Y-m-d');

                if ($currentDate <= $membershipDate)
                {
                    return redirect()->intended('/dashboard');
                }
                else
                {
                    echo '<script language="javascript">';
                    echo 'alert("Your company membership has been expired")';
                    echo '</script>';
                    Auth::logout();
                    return view('/signin');
                }
            }
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

    public function totalStudentsDetails()
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 3)
            {
                return view('/totalstudentsdetails');
            }
        }
        return redirect()->intended('/home');
    }

    public function totalCompaniesDetails()
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 3)
            {
                return view('/totalcompaniesdetails');
            }
        }
        return redirect()->intended('/home');
    }

    public function totalEventsDetails()
    {
        if (Auth::check())
        {
            if (Auth::user()->role == 3)
            {
                return view('/totaleventsdetails');
            }
        }
        return redirect()->intended('/home');
    }

    public function editProfile()
    {
        if (Auth::check())
            return view('/editprofile');
        else 
            return view('signin');
    }

    public function updateProfile(Request $request)
    {
        if (Auth::user()->role == 1)
        {
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));

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
            if (!empty($image))
            {
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/images/userpic/' . $filename);
                Image::make($image->getRealPath())->resize(150, 150)->save($path);
                $imageName = '/images/userpic/'.$filename;
                DB::table('students')->where('userid',Auth::user()->id)->update(['image'=> $imageName]);
            }

            if(!empty($email))
            {
                DB::table('users')->where('id',Auth::user()->id)->update(['email'=> $email]);
            }

            if(!empty($password))
            {
                DB::table('users')->where('id',Auth::user()->id)->update(['password'=> $password]);
            }

            if(!empty($firstName))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['firstName'=> $firstName]);
            }

            if(!empty($lastName))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['lastName'=> $lastName]);
            }

            if(!empty($dob))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['dob'=> $dob]);
            }

            if(!empty($phone))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['phone'=> $phone]);
            }

            if(!empty($campus))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['campus'=> $campus]);
            }

            if(!empty($gender))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['gender'=> $gender]);
            }

            if(!empty($education))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['education'=> $education]);
            }

            if(!empty($interest))
            {
                DB::table('students')->where('userid',Auth::user()->id)->update(['interest'=> $interest]);
            }
        }

        else if (Auth::user()->role == 2)
        {
            $password = bcrypt($request->input('password'));

            $phone = $request->input('phone');
            $aboutcompany = $request->input('aboutcompany');

            $image = $request->file('image');

            if(!empty($password))
            {
                DB::table('users')->where('id',Auth::user()->id)->update(['password'=> $password]);
            }

            if(!empty($phone))
            {
                DB::table('companies')->where('userid',Auth::user()->id)->update(['phone'=> $phone]);
            }

            if(!empty($aboutcompany))
            {
                DB::table('companies')->where('userid',Auth::user()->id)->update(['aboutcompany'=> $aboutcompany]);
            }

            if(!empty($image))
            {
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/images/userpic/' . $filename);
                Image::make($image->getRealPath())->resize(150, 150)->save($path);
                $imageName = '/images/userpic/'.$filename;
                DB::table('companies')->where('userid',Auth::user()->id)->update(['image'=> $imageName]);
            }
        }
        return redirect()->intended('dashboard');
    }
}
