<?php

namespace App\Http\Controllers\Job_Seeker;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Password;
use App\Job_Seeker;

class Job_Seeker_Forgot_Password extends Controller
{


    use SendsPasswordResetEmails;
    public function __construct(){
        $this->middleware('guest:job_seeker')->except('show_form');
        $this->middleware('auth:job_seeker')->only('show_form');

    }


    public function show_form($id){
        $job_seeker=Job_Seeker::find($id);
        $job_seeker_id=$job_seeker->id;
        $username=$job_seeker->username;
        return view('job_seeker.change_password_form',compact('job_seeker','job_seeker_id','username'));
    }
    public function show_reset_form(){
        return view('job_seeker.forgot-password');
    }

            public function broker()
        {
            return Password::broker('job_seekers');
        }

        public function guard()
        {
            return Auth::guard('job_seeker');
        }
}
