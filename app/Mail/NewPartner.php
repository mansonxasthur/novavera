<?php

namespace App\Mail;

use App\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPartner extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Partner
     */
    public $partner;

    /**
     * Create a new message instance.
     *
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Partner Request from ' . $this->partner->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.partner.request');
    }
}
