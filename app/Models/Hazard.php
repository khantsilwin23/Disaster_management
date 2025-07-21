<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hazard extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function riskZones()
    {
        return $this->hasMany(RiskZone::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
    
    public function tips()
    {
        return $this->hasMany(SafetyTip::class);
    }
}