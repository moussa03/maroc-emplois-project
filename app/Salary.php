<?php

namespace App;
use App\Job_offer;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $table = "salaries";
    protected $fillable = [
        'Name','id'
    ];
    public function job_offer(){
        return $this->hasMany(Job_offer::class);
    }
    
}
