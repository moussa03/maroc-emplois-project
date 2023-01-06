<?php
namespace App\Http\Controllers\job_seeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Seeker;
use App\Category;
use App\Location;
use Storage;
use App\Education;
use Image;
use Auth;
use App\Experience;
use App\Job_offer;
use App\Employer;
use Carbon\Carbon;
use App\Job_Seeker_Job_Offer;
use App\skills;
class Job_Seeker_Profile extends Controller
{


    public function __construct(){

        $this->middleware('auth:job_seeker');



    }


    public function update(Request $request,$id){
        $request->validate([
            'username' => 'required|max:6|min:3',
            'email' => 'required|unique:job_seekers|ends_with:outlook.live.com,gmail.com',
            'profile_picture'=>'mimes:jpeg,bmp,png|dimensions:min_width=100,min_height=200,max_width:300,max_height:300',
            'description'=>'required|min:124|max:250|regex:/^[\pL\s\-]+$/u',
            'category Name'=>'required',
            'location Name'=>'required',
            'age'=>'integer|min:16|max:70',
            'gender'=>'required',
            'phone_number'=>'integer',
            'website'=>'regex:/^[\pL\s\-]+$/u',
        ]);


        $job_seeker=Job_Seeker::find($id);
        $fileNameToStore=$job_seeker->profile_picture;
        if($request->hasFile('profile_picture')) {
        $image=$request->file('profile_picture');
        $fileNameToStore=time() . '.'. $image->getClientOriginalExtension();
        $location=public_path('img/'. $fileNameToStore);
       Image::make($image)->save($location);
       $old_filename= $job_seeker->profile_picture;
       if($old_filename!='job.png'){
        Storage::delete($old_filename);
         }
     }

     $old_filename= $job_seeker->profile_picture;
     $job_seeker=Job_Seeker::find($id);
     $job_seeker->username=request('username');
     $job_seeker->email=request('email');
     $job_seeker->description=request('description');
     $job_seeker->profile_picture=$fileNameToStore;
     $job_seeker->location_id=request('location_id');
     $job_seeker->category_id=request('category_id');
     $job_seeker->age=request('age');
     $job_seeker->gender=request('gender');
     $job_seeker->phone_number=request('gender');
     $job_seeker->phone_number=request('gender');

     $job_seeker->save();



 return back()->with('updated','your profile hass succefuly udpated');
 }

    public function show_profile(Job_Seeker $job_seeker,$id)
    {
        $job_seeker=Job_Seeker::findOrFail($id);
        $job_seeker_id=$job_seeker->id;
        $categories=Category::all();
        $locations=Location::all();
        $username=$job_seeker->username;
        abort_if($job_seeker_id!=Auth::guard('job_seeker')->user()->id, '403');
        return view('job_seeker.profile',compact('job_seeker','job_seeker_id','categories','locations','username'));






    }

    public function delete_profile($id){
        $job_seeker=Job_Seeker::find($id);
        Job_Seeker::where('id',$job_seeker->id)->delete();
        Job_Seeker_Job_Offer::where('job_seeker_id', $job_seeker->id)->delete();
        Education::where('job_seeker_id', $job_seeker->id)->delete();
        Experience::where('job_seeker_id', $job_seeker->id)->delete();
        skills::where('job_seeker_id', $job_seeker->id)->delete();
        return redirect()->route('job_seeker.login');
    }

   public function show_resume($id){
    $job_seeker=Job_Seeker::find($id);
    $job_seeker_id=$job_seeker->id;
    $educations=Education::where('job_seeker_id',$job_seeker_id)->get();
    $experience=Experience::where('job_seeker_id',$job_seeker_id)->get();
    $skill=skills::where('job_seeker_id',$job_seeker_id)->get();
    $education1=$educations->get(0);
    $education2=$educations->get(1);
    $education3=$educations->get(2);
    $experience1=$experience->get(0);
    $experience2=$experience->get(1);
    $experience3=$experience->get(2);
    $skill1=$skill->get(0);
    $skill2=$skill->get(1);
    $skill3=$skill->get(2);
    abort_if($job_seeker_id!=Auth::guard('job_seeker')->user()->id, '403');
    return view('job_seeker.resume',compact('job_seeker','job_seeker_id',
    'education1','education2','education3',
    'experience1','experience2','experience3',
    'skill1','skill2','skill3'
));
   }

}
