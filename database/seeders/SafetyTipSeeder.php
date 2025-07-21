<?php

namespace Database\Seeders;

use App\Models\Hazard;
use App\Models\SafetyTip;
use Illuminate\Database\Seeder;

class SafetyTipSeeder extends Seeder
{
    public function run(): void
    {
        $hazardIds = Hazard::pluck('id')->toArray();
        
        $tips = [
            [
                'title' => 'Flood Safety',
                'description' => 'Move to higher ground immediately. Do not walk through moving water. Avoid driving through flooded areas.'
            ],
            [
                'title' => 'Fire Safety',
                'description' => 'Stop, drop, and roll if caught in fire. Use fire extinguishers for small fires. Evacuate immediately if fire spreads.'
            ],
            [
                'title' => 'Earthquake Safety',
                'description' => 'Drop, cover, and hold on. Stay indoors until shaking stops. Avoid windows and heavy furniture.'
            ],
            [
                'title' => 'Landslide Safety',
                'description' => 'Move away from the path of the landslide. Listen for unusual sounds. Be alert when driving.'
            ],
            [
                'title' => 'Storm Safety',
                'description' => 'Stay indoors during thunderstorms. Avoid tall structures. Unplug electronic devices.'
            ]
        ];
        
        foreach ($tips as $index => $tip) {
            SafetyTip::create([
                'hazard_id' => $hazardIds[$index % count($hazardIds)],
                'title' => $tip['title'],
                'description' => $tip['description']
            ]);
        }
    }
}