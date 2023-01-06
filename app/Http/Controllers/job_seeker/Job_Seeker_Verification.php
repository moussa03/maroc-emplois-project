<?php
namespace App\Http\Controllers\job_seeker;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class Job_Seeker_Verification extends Controller
{
    use VerifiesEmails;
   
    public function __construct()
    {
        $this->middleware('auth:job_seeker');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('job_seeker.verify');
    }

   
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('job_seeker')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('job_seeker')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('job_seeker')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('job_seeker')->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
    }

