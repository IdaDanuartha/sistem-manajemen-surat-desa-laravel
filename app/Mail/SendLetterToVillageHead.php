<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendLetterToVillageHead extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected $letter_code;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $letter_code)
    {
        $this->user = $user;
        $this->letter_code = $letter_code;
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
            view: 'mail.send-letter-to-village-head',
            with: [
                'name' => $this->user->authenticatable->citizent->name,
                'code' => $this->letter_code,
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
