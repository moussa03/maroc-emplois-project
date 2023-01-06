<?php

namespace App;
use App\Job_offer;
use App\Employer;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use App\Job_Seeker;

class Category extends Model
{
//     public function categories(){
//     return $this->belongsTo('App\Categorie');
// }

protected $fillable = [
    'Name','id','label',
];

public $table = "categories";

public function job_offer(){
    return $this->hasMany(Job_offer::class);
}

public function employer(){

return $this->hasMany(Employer::class);

}

public function job_seeker(){
    return $this->hasMany(Job_Seeker::class);
}

}

