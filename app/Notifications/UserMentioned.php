<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserMentioned extends Notification
{
    use Queueable;
    private $sent_by;
    private $message;
    private $task_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sent_by, $task_id, $message)
    {
        $this->sent_by = $sent_by;
        $this->message = $message;
        $this->task_id = $task_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
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
            'sent_by'=>$this->sent_by,
            'task_id'=>$this->task_id,
            'message'=>$this->message
        ];
    }
}
