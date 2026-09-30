<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;

//use Illuminate\Bus\Queueable;

class EmailSendingJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public $data;
    public $subject;
    public $message;
    public function __construct($email,$subject,$message)
    {
      $this->data =   $email;
      $this->subject = $subject;
      $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data['email'] as $email) {
        Mail::to($email)->queue(new Websitemail($this->subject,$this->message));
        }
    }
}
