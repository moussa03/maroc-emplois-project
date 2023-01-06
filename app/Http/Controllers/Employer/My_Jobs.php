<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use App\tags;
use App\Category;
use App\Location;
use App\Salary;
use App\Job_offer;
use App\Job_Seeker;
use App\Job_Seeker_Job_Offer;
use Image;
use Mail;
use Auth;
use Storage;
use App\Mail\send_demand_offer;
use App\Notifications\random_offer_demand;
use Illuminate\Notifications\Notifiable;
use Notification;


class My_Jobs extends Controller
{
    use Notifiable;
    public function __construct(){

        $this->middleware('auth:employer')->except('send_random_offer');

    }

public function show_offer($id,$offer_id){
    $employer = Employer::findOrFail($id);
    $job_offer=Job_offer::findOrFail($offer_id);
    $employer_id=$employer->id;
    $tags = tags::all();
    $categories = Category::all();
    $locations = Location::all();
    $salaries = Salary::all();
    $related_job_offers=Job_offer::where(['id'=>$job_offer->id,'employer_id'=>$employer->id])->get();
    abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
    return view('employer.single_offer',compact('employer','employer_id','tags','categories','locations','salaries','related_job_offers','job_offer'));
}

public function update_single_offer(Request $request,$id,$offer_id){
    $request->validate([
        'offer_title'=>'required|min:10|max:250|regex:/^[\pL\s\-]+$/u',
        'type_emploi'=>'required',
        // 'description' =>'required|regex:[\s]|max:250|min:40',
        'description'=>"required",
        'categorie'=>'required',
        'salary'=>'required',
        'location'=>'required',
        'offer_image'=>'mimes:jpeg,bmp,png',
    ]);
    $employer = Employer::findOrFail($id);
    $job_offer=Job_offer::findOrFail($offer_id);
    $employer_id=$employer->id;
    $related_job_offers=Job_offer::where(['id'=>$job_offer->id,'employer_id'=>$employer->id])->get();
    foreach( $related_job_offers as $related_job_offer){
        $fileNameToStore=$related_job_offer->offer_image;
        if($request->hasFile('offer_image')) {
            $image=$request->file('offer_image');
            $fileNameToStore=time() . '.'. $image->getClientOriginalExtension();
            $location=public_path('img/'. $fileNameToStore);
           Image::make($image)->save($location);
           $old_filename= $related_job_offer->offer_image;
           if($old_filename!='job.png'){
            Storage::delete($old_filename);
        }
    }
        $related_job_offer->offer_image=$fileNameToStore;
        $related_job_offer->category_id=request('categorie');
        $related_job_offer->salary_id=request('salary');
        $related_job_offer->location_id=request('location');
        $related_job_offer->description=request('description');
        $related_job_offer->offer_title=request('offer_title');
        $related_job_offer->type_emploi=request('type_emploi');
        $job_offer->tags()->sync($request->input('tags'), false);
        $related_job_offer->save();
        return back()->with('updated','your job offer hass succefuly udpated');
    }
}

public function delete_single_offer($id,$offer_id){
    $employer = Employer::findOrFail($id);
    $job_offer=Job_offer::findOrFail($offer_id);
    $related_job_offers=Job_offer::where(['id'=>$job_offer->id,'employer_id'=>$employer->id])->delete();
    Job_Seeker_Job_Offer::where('job_offer_id',$job_offer->id)->delete();
    return back()->with('deleted','your job offer hass succefuly deleted');
}

// public function send_random_offer($id,$job_offer_id,Request $request){
//    $job_offer=Job_offer::findOrFail($job_offer_id);
//    $job_offer_title=$job_offer->offer_title;
//    $email = $request->input('email');
//    $employer=Employer::findOrFail($id);
//    Notification::route('mail', $employer->email)
//    ->notify(new random_offer_demand($email,$job_offer_title));

// }

public function send_random_offer($id,$job_offer_id,Request $request){
    $job_offer=Job_offer::findOrFail($job_offer_id);
    $job_offer_title=$job_offer->offer_title;
    $email = $request->input('email');

    if(($request->hasFile('file'))){
        $cv_name=$request->file('file');
        $fileNameToStore=time() . '.'. $cv_name->getClientOriginalExtension();
        // $path = Storage::putFileAs(
        //     'random_cv', $request->file('file'),$fileNameToStore
        // );
        $cv_name->move(public_path('cv_files/'), $fileNameToStore);
        }
    
        $data["email"] = "aatmaninfotech@gmail.com";
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";
 
        $files = [
            public_path('cv_files/'.$fileNameToStore),
        ];
  
        Mail::send('job_seeker.mail', $data, function($message)use($data, $files) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }
            
        });
 
      
    return back()->with('succes','you post succesfuly for this job bonne chance');
}
}
