<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegionController extends Controller
{
    public function provinces()
    {
        return response()->json(
            \Indonesia::allProvinces()
        );
    }
    public function city($province)
    {
        return response()->json(
            \Indonesia::findProvince($province, ['cities'])->cities
        );
    }
}
