<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanningMachine extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $case = [
        'in' => 'date:hh:mm',
        'out' => 'date:hh:mm',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    public function productions()
    {
        return $this->hasMany(Production::class);
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
}