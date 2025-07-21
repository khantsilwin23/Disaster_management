<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Hazard;
use App\Models\Alert;
use App\Models\SafetyTip;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();
    
    // Check if user has a role
    if (!$user->role) {
        // Assign default 'user' role if missing
        $userRole = Role::where('slug', 'user')->first();
        if ($userRole) {
            $user->role_id = $userRole->id;
            $user->save();
        }
    }
    
    $recentIncidents = Incident::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        
    $activeAlerts = Alert::where('user_id', $user->id)
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();
        
    return view('user.dashboard', compact('user', 'recentIncidents', 'activeAlerts'));
}
    
    public function reportIncident()
    {
        $hazards = Hazard::all();
        return view('user.report', compact('hazards'));
    }
    
    public function storeIncident(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'hazard_id' => 'required|exists:hazards,id',
            'description' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'severity' => 'required|integer|between:1,5'
        ]);
        
        $incident = Incident::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'hazard_id' => $validated['hazard_id'],
            'description' => $validated['description'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'severity' => $validated['severity'],
            'status' => 'reported'
        ]);
        
        return redirect()->route('user.dashboard')->with('success', 'Incident reported successfully!');
    }
    
    public function myIncidents()
    {
        $incidents = Incident::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('user.incidents', compact('incidents'));
    }
    
    public function safetyTips()
    {
        $hazards = Hazard::with('tips')->get();
        return view('user.safety-tips', compact('hazards'));
    }
    
    

    public function myAlerts()
{
    // Fetch all incidents instead of only user's
    $recentIncidents = Incident::latest()->take(10)->get();

    return view('user.alerts', compact('recentIncidents'));
}
}