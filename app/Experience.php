<?php

namespace App;
use App\Job_seeker;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $table = "experiences";
    protected $fillable = ['id','poste_name','entreprise_name','start_date','end_date','job_seeker_id','description'];

    public function job_seeker()
{
    return $this->belongsTo(Job_seeker::class);
}

}

