<?php

namespace App\Mail;

use App\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewApplicant extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        //
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New applicant (' . $this->applicant->name . ')')
            ->attach(storage_path('app/public/' . $this->applicant->cv))
            ->from('no-reply@novaverarealestate.com')
            ->markdown('emails.applicant.form');
    }
}
