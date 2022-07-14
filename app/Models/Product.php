<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
    public function imageables()
    {
        return $this->morphMany(Imageable::class, 'imageable');
    }
    public function process_productions()
    {
        return $this->belongsToMany(ProcessProduction::class);
    }
}
