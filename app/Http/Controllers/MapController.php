<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Resource;
use App\Models\RiskZone;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    public function show()
    {
        return view('map');
    }

    public function riskData()
{
    return response()->json([
        'risk_zones' => RiskZone::with('hazard')->get(),
        'incidents' => Incident::all(),
        'resources' => Resource::with('type')->get(),
    ]);
}

}