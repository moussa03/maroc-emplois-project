<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use App\Location;
use App\Category;
use App\Job_offer;
use App\Job_Seeker_Job_Offer;
use App\Job_Seeker;
use Response;
use Auth;
use Session;
class Dashboard_Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth:employer')->except('show_details','download_fiche');

    }

    public function show_dashboard($id){
        // $locations=Location::all();
        // $categories=Category::all();
        $employer= Employer::findOrFail($id);
        $employer_id=$employer->id;
        $job_offers=Job_offer::where('employer_id',$employer_id)->with('employer')->paginate(4);
        // $job_offer_count=Job_offer::where('employer_id',$employer_id)->get();
        // dd($job_offer_count->count());
        abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
        return view('employer.dashboard',compact('employer_id','employer','job_offers'));
    }

    public function show_jobs($id){
        // $categories=Category::all();
        $employer=Employer::findOrFail($id);
        $employer_id=$employer->id;
        $job_offers=Job_offer::where('employer_id',$employer_id)->with('employer')->withCount('job_seeker')->paginate(3);

        abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
        return view('employer.my_jobs',compact('employer_id','employer','job_offers'));
       }

       public function show_candidates(){
           return view('employer.random_candidates');
       }
    public function show_details($id){
        $employer=Employer::findOrFail($id);
        $employer_id=$employer->id;
        $cat_names=Category::where('id',$employer_id)->get();
        $location_names=Location::where('id',$employer_id)->get();
        $job_offers=Job_offer::where('employer_id',$employer_id)->with('employer')->paginate(4);
        return view('employer.details',compact('employer_id','employer','cat_names','location_names','job_offers'));
    }

        public function download_fiche(Request $request,$id){
            //PDF file is stored under project/public/download/info.pdf
            $employer=Employer::findOrFail($id);
            $employer_fiche= $employer->fiche;
            // $job_seeker_username=$employer->username;
           $file= public_path(). "/img/cv_files/$employer_fiche.pdf";

          $headers = array(
                  'Content-Type: application/pdf',
                );

            return Response::download($file, 'cv.pdf', $headers);
        }




}
