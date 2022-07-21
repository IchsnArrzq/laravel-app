<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Department extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];
    public function searchableAs()
    {
        return 'department_index';
    }
    public function toSearchableArray()
    {
        return $this->first()->toArray();
    }
}
