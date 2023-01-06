<?php

namespace App\Http\Middleware;

use Closure;
 use Illuminate\Support\Facades\Auth;
use App\Employer;
use Symfony\Component\Routing\Route;
// use Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function handle($request, Closure $next,$guard=null)
    {


        if (Auth::guard($guard)->check())
            return redirect('/home');

           if(Auth::guard('job_seeker')->check()){
           $job_seeker=Auth::guard('job_seeker')->user()->id;
           return redirect()->route('job_seeker/jobs',$job_seeker);
          }
          else if(Auth::guard('employer')->check()) {
          $employer=Auth::guard('employer')->user()->id;
          return redirect()->route('employer/dashboard',$employer);
          }

        return $next($request);
    }
}
