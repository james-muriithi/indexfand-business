<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawNotification extends Notification
{
    use Queueable;

    protected $withdraw, $message, $error;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($withdraw, $message, $error = false)
    {
        $this->withdraw = $withdraw;
        $this->message = $message;
        $this->error = $error;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->withdraw->business->businessOwner->name;
        if (!$this->error){
            return (new MailMessage)
                ->greeting('Hello '.ucfirst(array_filter(explode(' ', $name))[0]).',')
                ->line($this->message)
                ->action('View Withdraw', url(route('admin.withdraws.show', $this->withdraw->id)));
        }
        return (new MailMessage)
            ->greeting('Hello '.ucfirst(array_filter(explode(' ', $name))[0]).',')
            ->line($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($this->error){
            return [
                'message' => $this->message,
                'error'    => $this->error
            ];
        }
        return [
            'withdraw_id' => $this->withdraw->id,
            'message' => $this->message,
            'error'    => $this->error
        ];
    }
}
