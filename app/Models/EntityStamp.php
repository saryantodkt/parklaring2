<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entities;

class EntityStamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'stamp',
        'is_active',
    ];

    public function entity()
    {
        return $this->belongsTo(Entities::class);
    }
}
