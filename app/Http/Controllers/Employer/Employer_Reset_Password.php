<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use App\Employer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
class Employer_Reset_Password extends Controller
{

//     public function __construct(){
//     $this->middleware('guest:employer')->only('update_password');
// }
    use ResetsPasswords;
    public function broker()
    {
        return Password::broker('employers');
    }

    public function guard(){

        return Auth::guard('employer');
    }

    public function show_reset_form(Request $request,$token=null){

        return view('employer.reset_email')->with([
        'email' =>$request->email,
       'token'=>$token
    ]);
    }
    public function update_password($id,Request $request){
        $request->validate([
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        ]);
      $employer=Employer::find($id);
      $employer->password=Hash::make(request('password'));
      $employer->save();
      return redirect()->route('employer/dashboard',$employer->id)->with('updated','you change succefuly your password');


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
            if (Auth::guard('employer')->attempt(['email' => $request->email,
                     'password' => $request->password], $request->remember)) {
                        // if successful, then redirect to their intended location
                        return redirect()->intended(route('employer/dashboard',Auth::guard('employer')->user()->id));
                      }
        }else{
            //means reset failed
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }
    }
}
