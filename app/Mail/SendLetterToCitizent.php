<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendLetterToCitizent extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected $letter_code;
    protected $status;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $letter_code, $status)
    {
        $this->user = $user;
        $this->letter_code = $letter_code;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: "Surat Disetujui",
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.send-letter-to-citizent',
            with: [
                'name' => $this->user->authenticatable->name,
                'code' => $this->letter_code,
                'status' => $this->status
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
