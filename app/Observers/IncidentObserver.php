<?php

namespace App\Observers;

use App\Models\Incident;
use App\Models\User;
use App\Mail\IncidentCreatedMail;
use Illuminate\Support\Facades\Mail;

class IncidentObserver
{
    /**
     * Handle the Incident "created" event.
     */
    public function created(Incident $incident): void
    {
        // Get all users to notify
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new IncidentCreatedMail($incident));
        }
    }
}
