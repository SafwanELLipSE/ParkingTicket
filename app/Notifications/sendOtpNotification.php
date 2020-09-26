<?php

namespace App\Notifications;

use App\Ticket_user;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;

class sendOtpNotification extends Notification
{
    use Queueable;
    public $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function via($notifiable)
     {
         return ['nexmo'];
     }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toNexmo($notifiable)
     {

         $user = Ticket_user::where('id',$this->detail)->first();
         $mobile = $user->mobile;
         $otp = $user->otp;
         $carID = $user->car_number;
         $message = 'Hello, you just made a sale of $' .$otp. ' in your store';

         return (new NexmoMessage())
                     ->to($mobile)
                     ->content($message);
     }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
