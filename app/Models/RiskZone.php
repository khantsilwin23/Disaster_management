<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskZone extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function hazard()
    {
        return $this->belongsTo(Hazard::class);
    }
}