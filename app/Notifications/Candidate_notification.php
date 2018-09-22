<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
class Candidate_notification extends Notification
{
    use Queueable;
    protected $CandidateInfo;

    public function __construct($CandidateInfo)
    {
        $this->CandidateInfo = $CandidateInfo;
    }
   
    public function via($notifiable)
    {
        return ['database','mail'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'CandidateInfo' => $this->CandidateInfo,
            'user'=>$notifiable,
            'transaction_time' => Carbon::now(),
        ];
         
        
    }
    
   public function toMail($notifiable)
 
   {
 
       return (new MailMessage)
 
                   ->line('new candidate is added.')
 
                   ->action('Notification Action', url('/'))
 
                   ->line('Thank you for using our application!');
 
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
