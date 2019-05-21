<?php

namespace App\Mail;

use App\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectInquiry extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Inquiry
     */
    public $inquiry;

    /**
     * Create a new message instance.
     *
     * @param Inquiry $inquiry
     */
    public function __construct(Inquiry $inquiry)
    {
        //
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Inquiry from ' . $this->inquiry->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.contact.project');
    }
}
