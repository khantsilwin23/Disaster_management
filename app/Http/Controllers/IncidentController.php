<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Resource;
use App\Models\RiskZone;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Mail\IncidentCreatedMail;
use Illuminate\Support\Facades\Mail;


class IncidentController extends Controller
{


public function show(Request $request, $id)
{
    // Correctly fetch a single incident
    $incident = Incident::find($id);

    // Handle not found
    if (!$incident) {
        return abort(404, 'Incident not found.');
    }

    // Optional: log the incident for debugging
    Log::info($incident);

    // JSON response
    if ($request->wantsJson()) {
        return response()->json([
            'risk_zones' => RiskZone::where('id', $incident->hazard_id)->with('hazard')->get(),
            'incidents' => [$incident], // wrap in array for consistency
            'resources' => Resource::where('id', $incident->type_id)->with('type')->get(),
        ]);
    }

    // Blade view
   return view('incidents.map', [
        'incident' => $incident
    ]);
}



    public function riskData($id)
{
    return response()->json([
        'risk_zones' => RiskZone::with('hazard')->get(),
        'incidents' => Incident::where('id',$id)->get(),
        'resources' => Resource::with('type')->get(),
    ]);
}

public function store(Request $request)
{
    // 1) Validate
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'hazard_id' => 'nullable|integer',
        'type_id' => 'nullable|integer',
    ]);

    // 2) Create incident
    $incident = Incident::create($validated);

    // 3) Get all user emails (lightweight)
    $emails = User::whereNotNull('email')->pluck('email');

    // 4) Send one email per user
    foreach ($emails as $email) {
        Mail::to($email)->send(new IncidentCreatedMail($incident));
    }

    return redirect()
        ->route('incidents.index')
        ->with('success', 'Incident created. Emails sent to all users.');
}
}
