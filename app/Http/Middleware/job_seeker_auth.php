<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\job_seeker;
class job_seeker_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $job_seeker=Job_Seeker::find(14);
        $job_seeker_id=$job_seeker->id;

        if($job_seeker_id!=Auth::guard('job_seeker')->user()->id){
            abort('403');
        }
        return $next($request);
    }
}
