<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use App\Job_offer;
use App\Job_Seeker;
use Auth;
use App\Job_Seeker_Job_Offer;
class Candidate_Listing extends Controller
{
    public function __construct(){

        $this->middleware('auth:employer');

    }

    public function show_candidates($id,$offer_id){
        $employer=Employer::findOrFail($id);
        $job_offer=Job_offer::findOrFail($offer_id);
        $employer_id=$employer->id;
        $applicant=$job_offer->job_seeker()->paginate(4);
        abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
        return view("employer.candidates",compact('job_offer','applicant','employer','employer_id'));
    }

    public function delete_application($job_seeker_id,$offer_id){
        $job_seeker=Job_Seeker::findOrFail($job_seeker_id);
        $job_offer=Job_offer::findOrFail($offer_id);
        $job_seeker_job_offer=Job_Seeker_Job_Offer::where(['job_offer_id'=>$job_offer->id,'job_seeker_id'=> $job_seeker->id])->delete();
        return back();
      }

}
