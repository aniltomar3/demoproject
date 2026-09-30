<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Secondemail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailMsg; public $subject;
    public $filename;
    /**
     * Create a new message instance.
     */
    public function __construct($subject,$message,$photo_name)
    {
      $this->subject= $subject;  
      $this->mailMsg= $message;
      $this->filename= $photo_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Secondemail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.attachment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachment=[];
        if($this->filename){
            $attachment= [
                Attachment::fromPath(public_path('/image/'.$this->filename))
               //  Attachment::fromStorage();  // if stored in storage 
               //  Attachment::fromStorageDisk('s3','FILE PAth')
            ];
        }
      return $attachment;  
    }
}
