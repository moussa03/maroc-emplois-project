<?php
namespace App\Http\Controllers\job_seeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use App\Job_Seeker;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class Job_Seeker_ResetPassword extends Controller
{
    use ResetsPasswords;

    public function __construct(){
        $this->middleware('guest:job_seeker')->except('update_password');
    }

    public function broker()
    {
        return Password::broker('job_seekers');
    }

    public function guard()
    {
        return Auth::guard('job_seeker');
    }
    public function update_password($id,Request $request){
        $request->validate([
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);
      $job_seeker=Job_Seeker::find($id);
      $job_seeker->password=Hash::make(request('password'));
      $job_seeker->save();
      return redirect()->route('job_seeker/dashboard',$job_seeker->id)->with('updated','you change succefuly your password');


    }

    public function showResetForm(Request $request,$token=null){
        return view('job_seeker.reset_email')->with([
            'token'=>$token,
            'email'=>$request->email
            ]);

    }

    public function reset(Request $request)
{
    $validator = validator($request->all(), [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:5',
    ], $this->validationErrorMessages());

    if($validator->fails())
    {
        //do stuffs here like
        return redirect()->back()->withErrors($validator);
    }

    //if we get here means validation passed :) so lets allow these to continue

    // Here we will attempt to reset the user's password. If it is successful we
    // will update the password on an actual user model and persist it to the
    // database. Otherwise we will parse the error and return the response.
    $response = $this->broker()->reset(
        $this->credentials($request), function ($user, $password) {
        $this->resetPassword($user, $password);
    }
    );

    // If the password was successfully reset, we will redirect the user back to
    // the application's home authenticated view. If there is an error we can
    // redirect them back to where they came from with their error message.
    if($response == Password::PASSWORD_RESET)
    {
        //means password reset was successful
        if (Auth::guard('job_seeker')->attempt(['email' => $request->email,
                 'password' => $request->password], $request->remember)) {
                    // if successful, then redirect to their intended location
                    return redirect()->intended(route('job_seeker/jobs',Auth::guard('job_seeker')->user()->id));
                  }
    }else{
        //means reset failed
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
}
