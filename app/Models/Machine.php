<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Machine extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];
    public function planning_machines()
    {
        return $this->hasMany(PlanningMachine::class);
    }
    public function planning_machines_monitor()
    {
        return $this->hasMany(PlanningMachine::class)->whereDate('datetimein', Carbon::today())->orWhereDate('datetimeout', Carbon::today())->where('machine_id', $this->id);
    }
    public function production_status_monitor()
    {
        return $this->hasOne(Production::class, 'machine_id', 'id')->whereDate('created_at', now()->format('Y-m-d'))->whereTime('created_at', '>=', now()->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', now()->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc');
    }
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?  Carbon::parse($value)->diffForHumans() : $value,
            set: fn ($value) => $value
        );
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?  Carbon::parse($value)->diffForHumans() : $value,
            set: fn ($value) => $value
        );
    }
    protected function deletedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->diffForHumans() : $value,
            set: fn ($value) => $value
        );
    }
    public function searchableAs()
    {
        return 'machines_index';
    }
    public function toSearchableArray()
    {
        return $this->first()->toArray();
    }
}
