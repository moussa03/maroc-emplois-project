<?php

namespace App;
use App\Employer;
use Illuminate\Database\Eloquent\Model;
class team_members extends Model
{
    public $table = "team_members";
    protected $fillable = [
        'team_members','id'
    ];

    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}
