<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class experiences extends Model
{
    public $table = "experience";

    protected $fillable = ['id','Name'];

    public function job_offer(){
        return $this->hasMany(Job_offer::class);
    }

}
