<?php
namespace App\Http\Controllers\job_seeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Seeker;
use App\Job_offer;
use Auth;
use App\Job_Seeker_Job_Offer;
class myjobs extends Controller
{

     public function __construct(){
         $this->middleware('auth:job_seeker');
     }

    public function show_dashboard($id){
        $job_seeker=Job_Seeker::findOrFail($id);
        $job_seeker_id=$job_seeker->id;
        $username=$job_seeker->username;
        $related_job_offers=$job_seeker->job_offer()->paginate(4);
        $applied_jobs=$related_job_offers->count();
        $my_jobs=Job_offer::where(["category_id"=>$job_seeker->category_id,"location_id"=>$job_seeker->location_id])->get();

     //   $time=Carbon::now()->subDays($related_job_offers->pluck('created_at'))->diffForHumans();
        abort_if($job_seeker_id!=Auth::guard('job_seeker')->user()->id, '403');
        return view('job_seeker.dashboard',compact('job_seeker','job_seeker_id','username','related_job_offers','applied_jobs','my_jobs'));
    }

    public function applied_jobs($id){
        $job_seeker=Job_Seeker::findOrFail($id);
        $job_seeker_id=$job_seeker->id;
        $username=$job_seeker->username;
        $related_job_offers=$job_seeker->job_offer()->paginate(4);
        abort_if($job_seeker_id!=Auth::guard('job_seeker')->user()->id, '403');
      return view('job_seeker.applied_jobs',compact('job_seeker','job_seeker_id','username','related_job_offers'));
    }



    public function delete_applied_jobs($id,$job_offer_id){
        $job_seeker=Job_Seeker::find($id);
        $job_seeker_id=$job_seeker->id;
        $job_offer=Job_offer::find($job_offer_id);
        $job_offer_id=$job_offer->id;
        $deletedRows=Job_Seeker_Job_Offer::where(['job_offer_id'=>$job_offer_id,'job_seeker_id'=>$job_seeker_id ])->delete();
        return back();
    }


}
