<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'approver_name',
        'is_active',
    ];

    public function entity()
    {
        return $this->belongsTo(Entities::class);
    }
}
