<?php
namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use Auth;
use App\Job_offer;
use App\offer_tags;
use App\Category;
use App\Location;
use App\Salary;
use App\tags;
use App\Job_Seeker;
use Carbon\Carbon;
use App\Employer;
use App\experiences;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Image;

class JobOfferController extends Controller
{
    public function __construct(){

        $this->middleware(['auth:employer']);

    }

    public function register_job_offer($id)
    {
        $employer = Employer::findOrFail($id);
        $employer_id=$employer->id;
        $tags = tags::all();
        $categories = Category::all();
        $locations = Location::all();
        $salaries = Salary::all();
        $experiences=experiences::all();

        abort_if($employer_id!=Auth::guard('employer')->user()->id, '403');
        return view('employer.register_job_offer', compact('tags', 'categories', 'locations', 'salaries', 'employer_id','employer','experiences'));

    }
    public function store(Request $request)
    {
        
        $job_offer = new Job_offer;
        $validation=$request->validate([
            'offer_title'=>'required|min:10|max:250|regex:/^[\pL\s\-]+$/u',
            'type_emploi'=>'required',
            // 'description'=>'required|min:40|max:250|regex:/^[\pL\s\-]+$/u',
            'description'=>'required',
            'categorie'=>'required',
            'salary'=>'required',
            'location'=>'required',
            'offer_image'=>'mimes:jpeg,bmp,png,webp',

        ]);
     
        $fileNameToStore = 'job.png';
        if ($request->hasFile('offer_image')) {
            $image = $request->file('offer_image');
            $fileNameToStore = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/' . $fileNameToStore);
            Image::make($image)->resize(200, 200)->save($location);
        }

        $job_offer->employer_id = Auth::guard('employer')->user()->id;
        $job_offer->offer_title = $request->input('offer_title');
        $job_offer->type_emploi = $request->input('type_emploi');
        $job_offer->description = $request->input('description');
        $job_offer->category_id = $request->input('categorie');
        $job_offer->salary_id = $request->input('salary');
        $job_offer->location_id = $request->input('location');
        $job_offer->offer_image = $fileNameToStore;
        $job_offer->experience_id=$request->input('experience');
        $job_offer->created_at=Carbon::now();
        $job_offer->save();
        $job_offer->tags()->sync($request->input('tags'), false);
        return redirect()->route('employer/my_jobs',$job_offer->employer_id);
    }

}
