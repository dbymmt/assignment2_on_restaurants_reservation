<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class MemberOnlyNotification extends Notification
{
    use Queueable;

    private $user;
    private $mailTemplate;

    public function __construct($user, $mailTemplate)
    {
        $this->user = $user;
        $this->mailTemplate = $mailTemplate;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('owner.notification', ['user' => $this->user, 'mailTemplate' => $this->mailTemplate])
            ->subject('メールのタイトル')
            ->line('メールの本文')
            ->action('解約はこちら', url("/user/mail/exit?user_mail={$this->user->email}"));
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
