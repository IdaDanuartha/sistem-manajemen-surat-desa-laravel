<?php

namespace App\Jobs;

use App\Mail\SendLetterToVillageHead;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToVillageHeadQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $send_mail;
    protected User $user;
    protected $letter_code;
  
    /**
     * Create a new job instance.
     */
    public function __construct($send_mail, User $user, $letter_code)
    {
        $this->send_mail = $send_mail;
        $this->user = $user;
        $this->letter_code = $letter_code;
    }
  
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendLetterToVillageHead($this->user, $this->letter_code);
        Mail::to($this->send_mail)->send($email);
    }
}
