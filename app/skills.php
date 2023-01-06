<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skills extends Model
{

    public $table = "skills";
    protected $fillable = [
        'Name','performance','id','job_seeker_id'
    ];

}
