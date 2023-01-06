<?php

namespace App\Http\Controllers\Employer;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use App\Location;
use App\Category;
use Validator;

class Login_Employer_Controller extends Controller
{

    public function __construct(){
        $this->middleware(['guest:employer'],['except'=>'logout']);

    }

    public function showLoginForm(){
        $locations=Location::all();
        $categories=Category::all();
        return view('employer.login_employer',compact('locations','categories'));
    }

    public function login(Request $request){

        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters",
            "password_confirmation"=>"password must be confirmed"
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:employers,email',
            'password' => 'required|min:6|',
            'password_confirmation' => 'required|min:6|same:password',

        ], $messages);

        if ($validator->fails()) {
           
            return back()->withErrors($validator)->withInput();
        }
        else {
            if (Auth::guard('employer')->attempt(['email' => $request->email,
            'password' => $request->password], $request->remember)) {
               // if successful, then redirect to their intended location
            $employer=Auth::guard('employer')->user()->id;
            return redirect()->route('employer/dashboard',$employer);
       }
       return redirect()->back()->withInput($request->only('email','remember'))->with('status', 'password incorrect!');
        }
       
        

    }

    public function logout(Request $request)
    {
        Auth::guard('employer')->logout();

        $request->session()->invalidate();

        return  redirect('employer/login');
    }
}
