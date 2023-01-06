<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Job_Seeker;
use App\Employer;

class send_demand_offer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $path ;
    public function __construct($path )
    {
        $this->path =$path ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public $id;
    public $employer_id;
    public function build()
{
    return $this->view('job_seeker.mail')
    ->attach(public_path().'/img/'.$this->path, [
        'as' => 'name.pdf',
        'mime' => 'application/pdf',
    ]);
}
}
