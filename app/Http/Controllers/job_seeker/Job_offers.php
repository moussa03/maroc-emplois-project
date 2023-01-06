<?php
namespace App\Http\Controllers\job_seeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Seeker;
use App\Employer;
use App\Job_offer;
use App\Category;
use App\Location;
use App\Salary;
use Notification;
use Auth;
use Mail;
use App\Notifications\submit_job_demand;
use Illuminate\Notifications\Notifiable;
use DB;

// use App\Mail\send_demand_offer;


class Job_offers extends Controller
{
    use Notifiable;
    public function __construct()
    {
         $this->middleware('auth:job_seeker')->except('submit_single_offer');

        //    $this->middleware('job_seeker_verified');

    }
    public function show_offer_by_ajax(Request $request){
        $checked_category = $request->categories;
        $id=$request->job_seeker_id;
         $job_seeker=Job_Seeker::find($id);
        
        if ($request->ajax()) {
            $job_offers = Job_offer::where('category_id',$checked_category )->with('category')->get();
            return view('job_seeker.jobs-render', ['job_offers' => $job_offers,'job_seeker'=>$job_seeker])->render();  
        }
    }
    public function show_offers($id,Request $request)
    {  
        if ($request->ajax()) {
            $items=Category::paginate(4);
            return view('job_seeker.pagination_data', ['items' => $items])->render();  
        }
        
        $job_seeker=Job_Seeker::find($id);
        $job_offers = Job_offer::paginate(4);
        $categories = Category::all();
        $items=Category::paginate(4);
        $locations = Location::all();
        $salaries=Salary::all();
        $count = Job_offer::all()->count();
        abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');
        return view('job_seeker.job_listing', compact('job_offers', 'categories', 'locations', 'count','salaries','job_seeker','items'));
    }
    
    // public function send_demand_offer($id,$offer_id){

    //     $job_seeker=Job_Seeker::find($id,$job_seeker_id);
    //     $job_offer=Job_offer::find($offer_id);
    //     $job_seeker_id=$job_seeker->id;
    //     $job_offer_id=$job_offer->id;
    //     $employers=Employer::where('id', $job_offer->employer_id)->get();
        // $job_seeker->job_offer()->attach($job_offer_id);
        // Notification::send( $employers, new submit_job_demand);
        // }
    // public function searched_category($id,Request $request){
    //     $items = Category::paginate(5);
    //     if ($request->ajax()) {
    //         return view('job_seeker.pagination_data', compact('items'));
    //     }
    //     return view('items',compact('items'));
       
    //     $job_seeker=Job_Seeker::find($id);
    //     $job_offers = Job_offer::paginate(4);
    //     $categories = Category::paginate(7);
    //     $locations = Location::all();
    //     $salaries=Salary::all();
    //     $count = Job_offer::all()->count();
    //     abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');
    //     return view('job_seeker.job_listing', compact('job_offers', 'categories', 'locations', 'count','salaries','job_seeker'));

    // }

    public function show_single_offer($id,$offer_id){
        $job_seeker=Job_seeker::findOrFail($id);
        $job_offer=Job_offer::findOrFail($offer_id);
        abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');
        return view('job_seeker.single_offer',compact('job_offer','job_seeker'));
    }

    public function submit_single_offer($offer_id){
      $job_offer=Job_offer::findOrFail($offer_id);
      return view('job_seeker.submit_single_offer',compact('job_offer'));
    }

    // function fetch_data(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $data = DB::table('categories')->paginate(5);
    //   return view('job_seeker.pagination_data', compact('data'))->render();
    //  }
    // }
    
    
    public function show_offer_by_categorie(Request $request, Category $id,$job_seeker_id)
    {   
        $items=Category::paginate(4);
        $job_seeker=Job_seeker::find($job_seeker_id);
         $categories=Category::paginate(5);
        $locations = Location::all();
        $salaries = Salary::all();
        $job_offers = Job_offer::all();
        $count = Job_offer::all()->count();
        $job_offers = Job_offer::where([
            'category_id' => $request->search_category,
            'location_id' => $request->search_location
        ])->with('category', 'location', 'tags')->get();
        $count = Job_offer::all()->count();
        if (request('search_tag')) {
            $terms = explode(" ", request('search_tag'));
            $job_offers = Job_offer::query()
                ->whereHas('location', function ($query) use ($terms) {
                    foreach ($terms as $term) {
                        // Loop over the terms and do a search for each.
                        $query->where('Name', 'like', '%' . $term . '%')
                            ->orWhere('offer_title', 'like', '%' . $term . '%');
                    }
                })

                ->orWhereHas('tags', function ($query) use ($terms) {
                    foreach ($terms as $term) {
                        // Loop over the terms and do a search for each.
                        $query->where('Name', 'like', '%' . $term . '%')
                            ->orWhere('offer_title', 'like', '%' . $term . '%');
                    }
                })
                ->orWhereHas('category', function ($query) use ($terms) {
                    foreach ($terms as $term) {
                        // Loop over the terms and do a search for each.
                        $query->where('Name', 'like', '%' . $term . '%')
                            ->orWhere('offer_title', 'like', '%' . $term . '%');
                    }
                })
                ->orderBy('id', 'DESC')->get();

            $count = $job_offers->count();
            // if($request->ajax()){
            //     return response()->json($count);
            //    }

        }

        if (request('search_category')) {
            $job_offers = Job_offer::where('category_id', $request->search_category)->with('category', 'tags')->get();
            $count = $job_offers->count();

            // if($request->ajax()){

            //     return $job_offers;
          // }
        }

        if (request('search_location')) {
            $job_offers = Job_offer::where('location_id', $request->search_location)->with('location', 'tags')->get();
            $count = $job_offers->count();


        }

        if ((request('search_category') || (request('search_location')) || (request('search_tag'))) && ($job_offers->isEmpty())) {
            abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');

             return view('job_seeker.job_listing', compact('job_offers', 'categories', 'locations', 'salaries','count','job_seeker','items'))->with('failed', 'aucune offre disponible!');;
        }
        if (!(request('search_category') || (request('search_location')) || (request('search_tag'))) && ($job_offers->isEmpty())) {
            $job_offers = Job_offer::orderBy('id', 'DESC')->take(3)->get();
            $count = $job_offers->count();

            return view('job_seeker.job_listing', compact('job_offers', 'categories', 'locations', 'salaries', 'count','job_seeker','items'));
        }

        abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');

         return view('job_seeker.job_listing', compact('job_offers', 'categories', 'locations', 'salaries', 'count','job_seeker','items'));

    }


//  public function offer_by_ajax(Request $request,$cat_id){
//     if($request->ajax()){
//         $cat=$request->search_category;
//         if (request('search_category')) {
//             $job_offers = Job_offer::where('category_id', $cat)->with('category', 'tags')->get();
//             $count = $job_offers->count();
//             dd($count);

//         }
//     }



//  }
    public function display_single_offer($offer_id){
        $job_offer=Job_offer::find($offer_id);
        abort_if($job_seeker->id!=Auth::guard('job_seeker')->user()->id, '403');
        return view('job_seeker.single_offer',compact('job_offer'));
    }
   public function send_offer($id,$employer_id,$offer_id){
    $job_seeker=Job_seeker::find($id);
    $job_offer=Job_offer::find($offer_id);
    $employer=Employer::find($employer_id);
    // Notification::route('mail', $employer->email)
    // ->notify(new submit_job_demand($job_seeker));
    // $job_seeker->job_offer()->attach($job_offer->id);
    $job_offer->job_seeker()->attach($job_seeker->id);
    return redirect()->route('job_seeker/jobs',$job_seeker->id)->with('posted','your have poseted suuccesfully for this offer');;

    }

}
