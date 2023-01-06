<?php

namespace App;
use App\Job_offer;

use Illuminate\Database\Eloquent\Model;

class tags extends Model
{


    public function job_offers(){
         return $this->belongsToMany(Job_offer::class);
    }

}
