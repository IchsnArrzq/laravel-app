<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function planning_machine()
    {
        return $this->BelongsTo(PlanningMachine::class);
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
    public function toSearchableArray()
    {
        return $this->first()->toArray();
    }
}
