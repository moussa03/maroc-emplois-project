<?php
namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employer;
use App\Category;
use App\team_members;
use App\Location;
use Image;
use Auth;
use Storage;


class Profile_Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth:employer');


    }


    public function update(Request $request,$id){
        $request->validate([
            'username' => 'required|max:6|min:3',
            'email'=>'required|email|unique:employers',
            'profile_picture'=>'mimes:jpeg,bmp,png',
            'description'=>'required|min:124|max:250|regex:/^[\pL\s\-]+$/u',
            'category Name'=>'required',
            'location Name'=>'required',
            'age'=>'integer|min:16|max:70',
            'phone_number'=>'integer',
            'website'=>'regex:/^[\pL\s\-]+$/u',
            'entreprise Name'=>'regex:/^[\pL\s\-]+$/u',
        ]);
           $employer=Employer::find($id);
           $fileNameToStore='job.png';
        if ($request->hasFile('profile_picture')) {
           $image=$request->file('profile_picture');
           $fileNameToStore=time() . '.'. $image->getClientOriginalExtension();
           $location=public_path('img/'. $fileNameToStore);
           Image::make($image)->save($location);
           $old_filename= $employer->profile_picture;
           if($old_filename!='job.png'){
            Storage::delete($old_filename);
             }
        }
        $employer->username=request('username');
        $employer->description=request('description');
        $employer->team_members_id=request('team_mebers_value');
        $employer->age=request('age');
        $employer->gender=request('gender');
        $employer->profile_picture=$fileNameToStore;
        $employer->location_id=request('city');
        $employer->category_id=request('categorie');
        if($request->hasFile('fiche')){
            $cv=$request->file('fiche');
            $cvToStore=time() . '.'. $cv->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'cv_files', $request->file('fiche'),$cvToStore.'.pdf'
            );
            $employer->fiche=$cvToStore;
        }


        // if(!$old_filename){
        //     Storage::delete($old_filename);
        // }

        $employer->save();


    return back()->with('updated','your profile hass succefuly udpated');
    }

    public function show_profile($id){
        $employer=Employer::findOrFail($id);
        $employer_id=$employer->id;
        $categories=Category::all();
        $team_members=team_members::all();
        $locations=Location::all();
        $employer=Employer::find($id);
        $team_member=team_members::find($id);
        $categorie=Category::find($id);
        abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
        return  view('employer.profile',compact('employer','categories','team_member','team_members','locations','categorie','employer_id'));
    }

    public function delete_profile($id){
        $employer=Employer::findOrFail($id);
        Employer::where('id',$employer->id)->delete();
        return redirect()->route('employer/login');
    }

}
