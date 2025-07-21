<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function type()
    {
        return $this->belongsTo(ResourceType::class, 'type_id');
    }
}