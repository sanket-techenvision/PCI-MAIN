<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ApproveDraftMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $filename;
    /**
     * Create a new message instance.
     */
    public function __construct($details, $filename)
    {
        //custom
        $this->details = $details;
        $this->filename = $filename;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approve Draft Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.mails.approveMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // return [];
        return [
            Attachment::fromPath(storage_path('app/public/' . $this->filename))
                ->as('Approved_Draft.pdf')
                ->withMime('application/pdf')
        ];
    }
}
