<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use  App\Job_Seeker; 

class Job_seeker_Email_Verification extends Notification
{
    use Queueable;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $job_seeker;
    public function __construct(Job_Seeker $job_seeker)
    {
        $this->job_seeker=$job_seeker;
    }
    

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(
                Lang::get('Verify Email Address'),
                $this->verificationUrl($notifiable)
            )
            
            ->line(\Lang::get('If you did not create an account, no further action is required.'));            
            
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'job_seeker.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
