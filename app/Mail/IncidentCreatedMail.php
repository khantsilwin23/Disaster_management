<?php

namespace App\Mail;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncidentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $incident;

    /**
     * Create a new message instance.
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Incident Alert: ' . $this->incident->title)
            ->view('emails.incident_created');
    }
}
