<?php

namespace App;
use App\Job_seeker;
use App\Job_offer;
use Illuminate\Database\Eloquent\Model;

class Job_Seeker_Job_Offer extends Model
{
    public $table = "job_seeker_job_offer";
    protected $fillable = ['id','job_offer_id','job_seeker_id'];


}
