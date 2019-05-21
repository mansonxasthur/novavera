<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessaged extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Contact
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        //
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Message from ' . $this->contact->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.contact.message');
    }
}
