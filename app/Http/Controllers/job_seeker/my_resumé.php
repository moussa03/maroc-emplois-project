<?php

namespace App\Http\Controllers\job_seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Seeker;
use Auth;
use App\Education;
use App\Experience;
use App\skills;
use App\Category;
use Response;
use App\Location;
class my_resumé extends Controller
{

// public function show_job_seeker_detail(){

//     $job_seeker=Job_Seeker::findOrFail(1);
//     // $job_seeker_id=$job_seeker->id;
//     // $job_seeker_cat=$job_seeker->category_id;
//     // $job_seeker_loc=$job_seeker->location_id;
//     // $educations=Education::where('job_seeker_id',$job_seeker_id)->get();
//     // $experiences=Experience::where('job_seeker_id',$job_seeker_id)->get();
//     // $skills=skills::where('job_seeker_id',$job_seeker_id)->get();
//     // $job_seeker_cat_names=Category::where('id',$job_seeker_cat)->get();
//     // $job_seeker_loc_names=Location::where('id',$job_seeker_loc)->get();

//     return view('job_seeker.candidates',compact('job_seeker'));
// }


public function show_resume($id){

    $job_seeker=Job_Seeker::findOrFail($id);
    $job_seeker_id=$job_seeker->id;
    $job_seeker_cat=$job_seeker->category_id;
    $job_seeker_loc=$job_seeker->location_id;
    $educations=Education::where('job_seeker_id',$job_seeker_id)->get();
    $experiences=Experience::where('job_seeker_id',$job_seeker_id)->get();
    $skills=skills::where('job_seeker_id',$job_seeker_id)->get();
    $job_seeker_cat_names=Category::where('id',$job_seeker_cat)->get();
    $job_seeker_loc_names=Location::where('id',$job_seeker_loc)->get();
    return view('job_seeker.show_resumé',compact('educations','experiences','skills','job_seeker_cat_names','job_seeker','job_seeker_loc_names'));

}

public function download_resume(Request $request,$id){
    //PDF file is stored under project/public/download/info.pdf
    $job_seeker=Job_Seeker::find($id);
    $job_seeker_cv= $job_seeker->cv;
    $job_seeker_name=$job_seeker->username;
   $file= public_path(). "/img/cv_files/$job_seeker_cv.pdf";

  $headers = array(
          'Content-Type: application/pdf',
        );

    return Response::download($file, 'cv.pdf', $headers);
}


}
