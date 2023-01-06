<?php

namespace App\Http\Controllers\job_seeker;
use App\Job_seeker;
use App\skills;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class job_seeker_skills extends Controller
{

 public function fill_skills(Request $request,$id){
    $request->validate([
        'skill_name_1'=>'max:10|min:3|regex:/^[\pL\s\-]+$/u',
        'skill_name_2'=>'max:10|min:3|regex:/^[\pL\s\-]+$/u',
        'skill_name_3'=>'max:10|min:3|regex:/^[\pL\s\-]+$/u',
    ]);
    $job_seeker=Job_seeker::find($id);
        $job_seeker_id=$job_seeker->id;
        $skill= skills::where('job_seeker_id',$job_seeker_id)->get();

        if($skill->isEmpty()){
            skills::create([
                    'Name' =>  $request['skill_name_1'],
                    'performance' =>$request['skill_1'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                ]);
                skills::create([
                    'Name' =>  $request['skill_name_2'],
                    'performance' =>$request['skill_2'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                   ]);
                   skills::create([
                    'Name' =>  $request['skill_name_3'],
                    'performance' =>$request['skill_3'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                   ]);
            }
             if($skill->count()>0) {
               skills::where('id', $skill->get(0)->id)->update([
                                'Name' => $request['skill_name_1'],
                                'performance' =>$request['skill_1'],
                                'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
            ]);
            }
            if ($skill->count()>=1) {

                skills::where('id', $skill->get(1)->id)->update([
                    'Name' => $request['skill_name_2'],
                    'performance' =>$request['skill_2'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                    ]);
            }
            if ($skill->count()>=2) {
                skills::where('id', $skill->get(2)->id)->update([
                    'Name' => $request['skill_name_3'],
                    'performance' =>$request['skill_3'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                    ]);
            }
            return back()->with("skills",'skills has saved');
         }

   }





