<?php

namespace App\Mail;

use App\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreeConsultation extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var ConsultationRequest
     */
    public $consultationRequest;

    /**
     * Create a new message instance.
     *
     * @param ConsultationRequest $consultationRequest
     */
    public function __construct(ConsultationRequest $consultationRequest)
    {
        $this->consultationRequest = $consultationRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Consultation Request from ' . $this->consultationRequest->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.consultation.request');
    }
}
