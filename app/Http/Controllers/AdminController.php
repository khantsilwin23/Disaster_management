<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Incident;
use App\Models\Resource;
use App\Models\Hazard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Ensure user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action');
        }
        
        $stats = [
            'users' => User::count(),
            'incidents' => Incident::count(),
            'activeIncidents' => Incident::where('status', 'active')->count(),
            'resources' => Resource::count(),
        ];
        
        // Add these missing data variables
        $recentIncidents = Incident::with(['user', 'hazard'])
                                    ->latest()
                                    ->take(10)
                                    ->get();
        
        $recentUsers = User::latest()->take(5)->get();
         // ✅ Add pie chart data here
        $hazardData = Incident::select('hazards.name', DB::raw('COUNT(*) as total'))
            ->join('hazards', 'incidents.hazard_id', '=', 'hazards.id')
            ->groupBy('hazards.name')
            ->get();

        $hazardLabels = $hazardData->pluck('name');
        $hazardCounts = $hazardData->pluck('total');

        // ✅ Return all to view
        return view('admin.dashboard', compact(
            'stats',
            'recentIncidents',
            'recentUsers',
            'hazardLabels',
            'hazardCounts'
        ));
    }

    

    
    
    public function users()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users', compact('users'));
    }
    
    public function incidents()
    {
        $incidents = Incident::with('hazard', 'user')->paginate(10);
        return view('admin.incidents', compact('incidents'));
    }
    
    public function resources()
    {
        $resources = Resource::with('type')->paginate(10);
        return view('admin.resources', compact('resources'));
    }
    
    public function hazards()
    {
        $hazards = Hazard::all();
        return view('admin.hazards', compact('hazards'));
    }

    

    
}