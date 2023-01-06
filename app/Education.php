<?php

namespace App;
use App\Job_seeker;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $table = "education";
    protected $fillable = ['id','school_name','diplome_date','job_seeker_id','diplome_name','description'];

public function job_seeker()
{
    return $this->belongsTo(Job_seeker::class);
}


}

