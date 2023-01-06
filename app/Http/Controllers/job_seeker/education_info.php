<?php
namespace App\Http\Controllers\job_seeker;
use App\Education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Job_seeker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Storage;
use Image;
class education_info extends Controller
{

    public function __construct()
    {
         $this->middleware('auth:job_seeker');

        //    $this->middleware('job_seeker_verified');

    }
    public function register_education(Request $request,$id)
    {

        $request->validate([
            'file'=>'mimes:doc,docx,pdf',
            'diplome_name_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'school_name_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_1'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'diplome_date_1'=>'date|before:'.Carbon::now(),
            'diplome_name_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'school_name_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_2'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'diplome_date_2'=>'date|before:'.Carbon::now(),
            'diplome_name_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'school_name_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'description_3'=>'max:39|min:6|regex:/^[\pL\s\-]+$/u',
            'diplome_date_3'=>'date|before:'.Carbon::now(),


        ]);
        $job_seeker=Job_seeker::find($id);
        if($request->hasFile('cv')){
            $cv_name=$request->file('cv');
            $fileNameToStore=time() . '.'. $cv_name->getClientOriginalExtension();
            $job_seeker->cv=$fileNameToStore;
            $path = Storage::putFileAs(
                'cv_files', $request->file('cv'),$fileNameToStore.'.pdf'
            );
        }


        $job_seeker_name=$job_seeker->username;
        //  $file_name_to_store=$job_seeker->cv;



        $job_seeker->save();


        $job_seeker_id=$job_seeker->id;
        $education= Education::where('job_seeker_id',$job_seeker_id)->get();
         if($education->isEmpty()){
            Education::create([
                 'diplome_name' => $request['diplome_name_1'],
                 'school_name'=>$request['school_name_1'],
                 'diplome_date'=>$request['diplome_date_1'],
                 'description'=>$request['description_1'],
                 'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                ]);

                Education::create([
                    'diplome_name' => $request['diplome_name_2'],
                    'school_name'=>$request['school_name_2'],
                    'diplome_date'=>$request['diplome_date_2'],
                    'description'=>$request['description_2'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                   ]);

                   Education::create([
                    'diplome_name' => $request['diplome_name_3'],
                    'school_name'=>$request['school_name_3'],
                    'description'=>$request['description_3'],
                    'diplome_date'=>$request['diplome_date_3'],
                    'job_seeker_id'=>Auth::guard('job_seeker')->user()->id

                   ]);
            }
             if($education->count()>0) {
                Education::where('id',$education->get(0)->id)->update([
                                    'diplome_name' => $request['diplome_name_1'],
                                     'school_name' =>$request['school_name_1'],
                                     'diplome_date'=>$request['diplome_date_1'],
                                     'description'=>$request['description_1'],
                                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                             ]);
            }
            if ($education->count()>=1) {

                Education::where('id',$education->get(1)->id)->update([
                                    'diplome_name' => $request['diplome_name_2'],
                                     'school_name' =>$request['school_name_2'],
                                     'diplome_date'=>$request['diplome_date_2'],
                                     'description'=>$request['description_2'],
                                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                             ]);
            }
            if ($education->count()>=2) {
                Education::where('id',$education->get(2)->id)->update([
                                    'diplome_name' => $request['diplome_name_3'],
                                     'school_name' =>$request['school_name_3'],
                                     'diplome_date'=>$request['diplome_date_3'],
                                     'description'=>$request['description_3'],
                                     'job_seeker_id'=>Auth::guard('job_seeker')->user()->id
                             ]);
            }
            return back()->with("education",'education has saved');
         }

     }








