<?php
namespace App\Http\Controllers\job_seeker;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Category;
use App\Location;
use Socialite;
use Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests ;

use Illuminate\Http\Request;

class Login_Job_Seeker_Controller extends Controller
{
    public function __construct(){
        $this->middleware(['guest:job_seeker'],['except'=>'logout']);
    }
    public function redirectPath(){
        redirect('home');
    }

    public function showloginform(){
        $categories=Category::all();
        $locations=Location::all();
        return view('job_seeker.login_form',compact('categories','locations'));
    }

    public function login(Request $request){
       
       
        // $this->validate($request, [
        //     'email'=> 'required|max:255|email',
        //     'password'=> 'required',
        // ]);
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters"
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:job_seekers,email',
            'password' => 'required|min:6'
        ], $messages);
        
        if ($validator->fails()) {
           
            return back()->withErrors($validator)->withInput();
        }
        else {
        if (Auth::guard('job_seeker')->attempt(['email' => $request->email,
        'password' => $request->password], $request->remember)) {
           // if successful, then redirect to their intended location
        $job_seeker=Auth::guard('job_seeker')->user()->id;
        return redirect()->route('job_seeker/jobs',$job_seeker);
           }
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('status', 'password incorrect!');
        }

    //     if (Auth::guard('job_seeker')->attempt(['email' => $request->email,
    //     'password' => $request->password], $request->remember)) {
    //        // if successful, then redirect to their intended location
    //     $job_seeker=Auth::guard('job_seeker')->user()->id;
    //     return redirect()->route('job_seeker/jobs',$job_seeker);
    //        }

    //    return redirect()->back()->withInput($request->only('email','remember'));


    }
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->fields([
            'name', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'avatar'
        ])->scopes([
            'email'
        ])->redirect();



    }

    public function handleProviderCallback()
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook'));

        auth()->login($user);

        return redirect()->to('/home');

    }
    public function logout(Request $request)
    {
        Auth::guard('job_seeker')->logout();
        Session::flush();
        return  redirect('job_seeker/index');
    }
}


