<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReserve extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope();

        return $envelope->subject('予約登録完了のお知らせ')
                    ->from('noreplay@gmail.com')
                    ->to('testfukuda60210991@gmail.com');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url = url('/reserve/edit/'.$this->id);

        $content = new Content();
        return $content->markdown('emails.reserve')
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
