<?php

namespace App\Http\Controllers\job_seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_offer;
use App\Job_seeker;
use App\Employer;
use  App\Job_Seeker_Job_Offer;
use App\Category;
use App\Location;

class home_job_seeker extends Controller
{

    public function show_index(){

        $latest_job_offers=Job_offer::orderBy('id', 'DESC')->take(10)->get();
        $all_jobs=Job_offer::all();
        $all_jobs_seeker=Job_seeker::all();
        $all_employers=Employer::all();
        $all_application=Job_Seeker_Job_Offer::all();
        $all_categories=Category::all();
        $all_locations=Location::all();
        return view('job_seeker.home',compact('latest_job_offers','all_jobs','all_jobs_seeker','all_employers','all_application','all_categories','all_locations'));
    }

}
