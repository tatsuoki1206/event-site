<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserSignup extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    /**
     * Create a new message instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {   
        $envelope = new Envelope();

        return $envelope->subject('ユーザ登録完了のお知らせ')
                    ->from('noreplay@gmail.com')
                    ->to('testfukuda60210991@gmail.com');

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /*
        return new Content(
            markdown: 'emails.contact',
            text: 'emails.contact',
        );
        */
        $url = url('/');

        $content = new Content();
        return $content->markdown('emails.signup')
            ->with(['name' => $this->name, 'url' => $url]);
        
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
