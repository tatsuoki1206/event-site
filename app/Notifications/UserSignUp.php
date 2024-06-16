<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSignup extends Notification
{
    use Queueable;

    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        //return (new MailMessage)->markdown('mail.registered');

        return (new MailMessage)
        ->from('noreplay@gmail.com', config('app.name'))
        ->subject('ユーザ登録完了のお知らせ')
        ->line($this->name.'様')
        ->line('ユーザー登録が完了しました。ログイン出来るかお試しください。')
        ->action('ログイン画面へ', url('/'))
        ->line('本システムをご登録いただきありがとうございます。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
