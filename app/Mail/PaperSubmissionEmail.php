<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaperSubmissionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailBody;

    public function __construct($body)
    {
        $this->emailBody = $body;
    }
    /**
     * Create a new message instance.
     */
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: $this->emailTitle,
            subject: "Paper Submissioin (" . $this->emailBody . ")",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     view: 'pages.email-template.paper-submission',
        // );
        return new Content(
            view: 'pages.email-template.paper-submission',
            with: [
                'paper_no' => $this->emailBody,
            ],
        );
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
