<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaperSubmissionCoAuthorEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $paper_no, $title, $name, $contributor_rule;

    public function __construct($paper_no, $title, $name, $contributor_rule)
    {
        $this->paper_no = $paper_no;
        $this->title = $title;
        $this->name = $name;
        $this->contributor_rule = $contributor_rule;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Acknowledgement Paper (" . $this->paper_no . ")",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.email-template.paper-submission-co-author',
            with: [
                'paper_no' => $this->paper_no,
                'name' => $this->name,
                'title' => $this->title,
                'contributor_rule' => $this->contributor_rule,
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
