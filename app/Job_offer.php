<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Salary;
use App\Location;
use App\Job_Seeker;
use SoftDeletes;
use Carbon;


class Job_offer extends Model
{
    public $table = "job_offer";
    protected $fillable = [
        'employer_id','offer_title','type_emploi','description','offer_image','category_id','salary_id','location_id'
    ];
    protected $dates = ['created_at'];

    public $timestamps = false;
    public function employer()
{
    return $this->belongsTo(Employer::class);
}

public function tags(){
    return $this->belongsToMany(tags::class,'job_offer_tags','job_offer_id','tags_id');

}

public function category(){
    return $this->belongsTo(Category::class);
}


public function salary(){
    return $this->belongsTo(Salary::class);
}
public function location(){
    return $this->belongsTo(Location::class);
}

public function experience(){
    return $this->belongsTo(experiences::class);

}

public function job_seeker(){

    return $this->belongsToMany(Job_Seeker::class,'job_seeker_job_offer','job_offer_id','job_seeker_id')->withTimestamps();;
}



}
