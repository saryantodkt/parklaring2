<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    use HasFactory;
    protected $table = 'entities';

    public function stamps()
    {
        return $this->hasMany(EntityStamp::class, 'entity_id', 'id');
    }
}
