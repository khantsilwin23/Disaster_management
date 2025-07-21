<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Resource;
use App\Models\RiskZone;
use Illuminate\Support\Facades\Log;

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


}
