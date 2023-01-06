<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Employer_Reset_Password_Notfication;
use App\Job_offer;
use App\team_members;
class Employer extends Authenticatable
{

    use Notifiable;
    protected $guard='employer';
    protected $fillable = [
        'username', 'email','location_id','category_id', 'password','profile_picture','description','phone_number','team_members_id','entreprise_name','description','employer_image','post_in_entreprise','id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $table = "employers";

    public function sendPasswordResetNotification($token)
{
    $this->notify(new Employer_Reset_Password_Notfication($token));
}

// public function job_offers()
//     {
//         return $this->hasMany('App\Job_offer');
//     }

public function team_members(){
    return $this->belongsTo(team_members::class);
}

public function location(){
    return $this->belongsTo(Location::class);
}
 public function category(){
    return $this->belongsTo(Category::class);
}

public function job_offer(){
return $this->hasMany(Job_offer::class);
}

}


