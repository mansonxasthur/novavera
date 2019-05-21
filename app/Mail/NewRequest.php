<?php

namespace App\Mail;

use App\PropertyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRequest extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var PropertyRequest
     */
    public $propertyRequest;

    /**
     * Create a new message instance.
     *
     * @param PropertyRequest $propertyRequest
     */
    public function __construct(PropertyRequest $propertyRequest)
    {
        //
        $this->propertyRequest = $propertyRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Property Request from ' . $this->propertyRequest->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.property.request');
    }
}
