<?php

namespace App\Http\Controllers\Employer;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Auth;


class Employer_Forgot_Password extends Controller
{
    public function __construct(){

        $this->middleware('auth:employer')->only('show_form');

    }
    use SendsPasswordResetEmails;
    public function show_link_request_form(){
        return view('employer.forgot_password');
    }

    public function show_form($id){
    $employer=Employer::find($id);
    $employer_id=$employer->id;
    return view('employer.change_password_form',compact('employer','employer_id'));
    }
    public function broker()
    {
        return Password::broker('employers');
    }

    public function guard(){

        return Auth::guard('employer');
    }

}
