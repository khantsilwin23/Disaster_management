<?php

namespace Database\Seeders;

use App\Models\Hazard;
use Illuminate\Database\Seeder;

class HazardSeeder extends Seeder
{
    public function run(): void
    {
        $hazards = [
            ['name' => 'Flood', 'description' => 'Water overflow'],
            ['name' => 'Fire', 'description' => 'Wildfire or urban fire'],
            ['name' => 'Earthquake', 'description' => 'Seismic activity'],
            ['name' => 'Landslide', 'description' => 'Soil movement'],
            ['name' => 'Storm', 'description' => 'Severe weather conditions'],
        ];
        
        foreach ($hazards as $hazard) {
            Hazard::create($hazard);
        }
    }
}