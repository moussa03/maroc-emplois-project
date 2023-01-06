<?php
namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Employer;
use Auth;
use App\Category;
use App\Location;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class Register_Employer_Controller extends Controller
{
    protected $guard='employer';

    public function __construct(){

        $this->middleware('guest:employer');

    }

    public function show_register_form(){
        $locations=Location::all();
        $categories=Category::all();
        return view('employer.register_employer',compact('locations','categories'));
    }


    public function store(Request $request){
        // $request->validate([
        //    'username'=>'min:4|max:10',
        //    'email'=>'unique:employers|ends_with:outlook.live.com,gmail.com',
        //    'location'=>'required',
        //    'category'=>'required',
        //    'entreprise_name'=>'min:3|max:10|regex:/^[\pL\s\-]+$/u',
        //    'profile_picture'=>'mimes:jpeg,bmp,png',
        //    'password'=>'bail|min:4|required|confirmed',

        // ]);
        $request->validate([
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        ]);
        $fileNameToStore='job.png';
        if ($request->hasFile('profile_picture')) {
            $image=$request->file('profile_picture');
            $fileNameToStore=time() . '.'. $image->getClientOriginalExtension();
            $location=public_path('img/'. $fileNameToStore);
            Image::make($image)->resize(200,200)->save($location);
        }

        // $this->validate(request(),[
        //     'username' => 'bail|min:4|required|max:255',
        //     'email' => 'required|unique:employers|ends_with:outlook.live.com,gmail.com',
        //     'location_id'   =>'required',
        //     'category_id' =>'required',
        //     'entreprise_name' =>'bail|min:3|required',
        //     'password'=>'min:3|required',
        // ]);


        // Employer::create([
        //     'username' => $request['username'],
        //     'email'    =>  $request['email'],
        //     'location_id' => $request['city'],
        //     'category_id'=> $request['job_categorie'],
        //     'entreprise_name'=>$request['entreprise_name'],
        //     'password' => Hash::make($request['password']),

        // ]);
        $employer=new Employer;
        $employer->username=$request->input('username');
        $employer->email=$request->input('email');
        $employer->location_id=$request->input('location_id');
        $employer->category_id=$request->input('category_id');
        $employer->profile_picture=$fileNameToStore;
        $employer->entreprise_name=$request->input('entreprise_name');
        $employer->password=Hash::make($request['password']);
        $employer->save();
        $id= $employer->id;

        if (Auth::guard('employer')->attempt(['email' => $request->email,
                 'password' => $request->password], $request->remember)) {
                    // if successful, then redirect to their intended location
                    return redirect()->intended(route('employer/dashboard',$id));
        }
    }

}

