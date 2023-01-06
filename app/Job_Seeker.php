<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Job_seeker_ResetPasswordNotification;
use App\Notifications\Job_seeker_Email_Verification;
use App\Job_offer;
use SoftDeletes, CascadeSoftDeletes;




class Job_Seeker extends Authenticatable implements MustVerifyEmail
{
    protected $cascadeDeletes = ['job_seeker_job_offer'];

    use Notifiable;

    public $table = "job_seekers";
    protected $guard='job_seeker';
    protected $fillable = [
        'username', 'email','category_id','current_job', 'password','location_id','cv','age','description','gender','profile_picture'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendPasswordResetNotification($token)
{
    $this->notify(new Job_seeker_ResetPasswordNotification($token));
}

public function location(){
    return $this->belongsTo(Location::class);
}

public function category(){
    return $this->belongsTo(Category::class);
}

public function education()
{
    return $this->hasMany(Education::class);
}


    public function job_offer()
    {

        return $this->belongsToMany(Job_offer::class,'job_seeker_job_offer','job_seeker_id','job_offer_id')->withTimestamps();
    }




}
