<?php

namespace App\Jobs;

use App\Mail\SendLetterMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $send_mail;
    protected User $user;
  
    /**
     * Create a new job instance.
     */
    public function __construct($send_mail, User $user)
    {
        $this->send_mail = $send_mail;
        $this->user = $user;
    }
  
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendLetterMail($this->user);
        Mail::to($this->send_mail)->send($email);
    }
}
