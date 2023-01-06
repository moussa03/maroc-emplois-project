<?php

namespace App;
use App\Job_offer;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use App\Employer;
use App\Job_Seeker;

class Location extends Model
{
    public $table = "locations";
    protected $fillable = [
        'Name','id'
    ];
    public function job_offer(){
        return $this->hasMany(Job_offer::class);
    }

    public function employer()
    {
        return $this->hasMany(Employer::class);
    }
    public function job_seeker(){
        return $this->hasMany(Job_Seeker::class);
    }
}
