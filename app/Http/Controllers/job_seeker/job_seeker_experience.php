<?php

namespace App\Http\Controllers\job_seeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_seeker;
use Auth;
use Carbon\Carbon;
use App\Experience;
class job_seeker_experience extends Controller
{
    public function register_experience(Request $request,$id){
        $request->validate([
            'poste_name_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'entreprise_name_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'start_date_1'=>'date|before:'.Carbon::now(),
            'end_date_1'=>'date|before:'.Carbon::now(),
            'poste_name_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'entreprise_name_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'start_date_2'=>'date|before:'.Carbon::now(),
            'end_date_2'=>'date|before:'.Carbon::now(),
            'poste_name_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'entreprise_name_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'start_date_3'=>'date|before:'.Carbon::now(),
            'end_date_3'=>'date|before:'.Carbon::now(),
        ]);
        $job_seeker=Job_seeker::find($id);
        $job_seeker_id=$job_seeker->id;
        $experience= Experience::where('job_seeker_id',$job_seeker_id)->get();
         if($experience->isEmpty()){
            Experience::create([
                    'poste_name' => $request['poste_name_1'],
                     'entreprise_name' =>$request['entreprise_name_1'],
                     'start_date'=>$request['start_date_1'],
                     'description'=>$request['description_1'],
                     'end_date'=>$request['end_date_1'],
                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                ]);
                Experience::create([
                    'poste_name' => $request['poste_name_2'],
                    'entreprise_name' =>$request['entreprise_name_2'],
                    'description'=>$request['description_2'],
                    'start_date'=>$request['start_date_2'],

                    'end_date'=>$request['end_date_2'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                   ]);
                   Experience::create([
                    'poste_name' => $request['poste_name_3'],
                     'entreprise_name' =>$request['entreprise_name_3'],
                     'start_date'=>$request['start_date_3'],
                     'description'=>$request['description_3'],
                     'end_date'=>$request['end_date_3'],
                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                   ]);
            }
             if($experience->count()>0) {
                Experience::where('id',$experience->get(0)->id)->update([
                    'poste_name' => $request['poste_name_1'],
                     'entreprise_name' =>$request['entreprise_name_1'],
                     'start_date'=>$request['start_date_1'],
                     'description'=>$request['description_1'],
                     'end_date'=>$request['end_date_1'],
                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                    ]);
            }
            if ($experience->count()>=1) {

                Experience::where('id',$experience->get(1)->id)->update([
                    'poste_name' => $request['poste_name_2'],
                     'entreprise_name' =>$request['entreprise_name_2'],
                     'start_date'=>$request['start_date_2'],
                     'description'=>$request['description_2'],
                     'end_date'=>$request['end_date_2'],
                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                    ]);
            }
            if ($experience->count()>=2) {
                Experience::where('id',$experience->get(2)->id)->update([
                    'poste_name' => $request['poste_name_3'],
                     'entreprise_name' =>$request['entreprise_name_3'],
                     'start_date'=>$request['start_date_3'],
                     'description'=>$request['description_3'],
                     'end_date'=>$request['end_date_3'],
                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                    ]);
            }
            return back()->with("experience",'education has saved');
         }

   }





