<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ProcessProduction extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function searchableAs()
    {
        return 'process_production_index';
    }
    public function toSearchableArray()
    {
        return $this->first()->toArray();
    }
}
