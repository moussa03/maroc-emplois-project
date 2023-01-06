<?php
namespace App\Http\Controllers\job_seeker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Job_seeker_Email_Verification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Seeker;
use Auth;
use App\Category;
use App\Location;
use Illuminate\Foundation\Auth\RegistersUsers;

class Job_Seeker_Controller extends Controller
{


    public function __construct(){
        $this->middleware('guest:job_seeker');

    }

    protected $guard='job_seeker';

//
// ─── SHOW LOGIN FORM FOR JOB SEEKER ─────────────────────────────────────────────
//


public function show_register_form(){

    $categories=Category::all();
    $locations=Location::all();
    return view('job_seeker.register_job_seeker',compact('locations','categories'));
}

    //
    // ─── REGISTER FUNCTION FOR JOB SEEKER ───────────────────────────────────────────
    //

    // protected function validator(array $data)
    // {


    // }
    public function register(Request $request){

        $request->validate([
            'username' => 'required|max:6|min:3',
            'email' => 'required',
            'location_id'=>'required',
            'category_id'=>'required',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'

        ]);


            $fileNameToStore='job.png';
            $job_seeker=new Job_Seeker();
            $job_seeker->username=request('username');
            $job_seeker->email=request('email');
            $job_seeker->location_id=request('location_id');
            $job_seeker->category_id=request('category_id');
            $job_seeker->password=Hash::make(request('password'));
            $job_seeker->profile_picture=$fileNameToStore;
            $job_seeker->save();


                // $job_seeker->notify(new Job_seeker_Email_Verification($job_seeker));

                if (Auth::guard('job_seeker')->attempt(['email' => $request->email,
                 'password' => $request->password], $request->remember)) {
                    $job_seeker=Auth::guard('job_seeker')->user()->id;
                    // if successful, then redirect to their intended location
                    return redirect()->intended(route('job_seeker/jobs',$job_seeker));
                  }

       }
       public function register_news_letter(Request $request){
            $request->validate([
            'username' => 'bail|min:4|required|max:255',
            'email' => 'required|unique:job_seekers|ends_with:outlook.live.com,gmail.com',
            'password'=>'bail|min:3|required',
        ]);
            Job_Seeker::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),

                ]);
                // $job_seeker->notify(new Job_seeker_Email_Verification($job_seeker));
            return back()->with('success','vous aurez tous les nouveaux offres en email');

       }

}
