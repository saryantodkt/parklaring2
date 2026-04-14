<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParklaringInfo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'parklaring_info';

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Entities::class, 'entity_id', 'id');
    }

    public function contracts() {
        return $this->hasMany(Contracts::class, 'parklaring_info_id', 'id')->orderBy('contract_start_date', 'asc');
    }

    public function probationStatuses() {
        return $this->belongsTo(ProbationStatuses::class, 'probation_status_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(Approver::class, 'approver_id', 'id');
    }

    public function entityStamp()
    {
        return $this->belongsTo(EntityStamp::class, 'entity_stamp_id', 'id');
    }
}
