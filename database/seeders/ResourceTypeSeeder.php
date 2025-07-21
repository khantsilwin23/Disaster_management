<?php

namespace Database\Seeders;

use App\Models\ResourceType;
use Illuminate\Database\Seeder;

class ResourceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Ambulance', 'icon' => 'fa-ambulance'],
            ['name' => 'Fire Truck', 'icon' => 'fa-fire-extinguisher'],
            ['name' => 'Police Car', 'icon' => 'fa-car'],
            ['name' => 'Helicopter', 'icon' => 'fa-helicopter'],
            ['name' => 'Rescue Team', 'icon' => 'fa-user-shield'],
        ];
        
        foreach ($types as $type) {
            ResourceType::create($type);
        }
    }
}