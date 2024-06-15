<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    use Queueable;

    /**
    * The password reset token.
    * 
    * @var string
    */
    public $token;

    /**
     * Create a new notification instance.
     */
    
    public function __construct($token)
    {
        $this->token = $token;
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
        
        // トークンとメールアドレスを取得
        $reset_user = ['email' => $notifiable->getEmailForPasswordReset()];
        $this->email = $reset_user['email'];

        $url = url('/reset_password/'.$this->token.'/'.$this->email);
        
        return (new MailMessage)
            ->from('noreplay@gmail.com', config('app.name'))
            ->subject('パスワード再設定のお知らせ')
            ->line('下記ボタンまたはURLより再設定ください。1時間が経過すると無効になります。')
            ->action('パスワード再設定画面はこちら', $url)
            ->line('本システムをご利用いただき誠にありがとうございます。');
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
