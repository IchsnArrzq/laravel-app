<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegionController extends Controller
{
    public function provinces()
    {
        return response()->json(
            Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')['provinsi']
        );
    }
    public function city($province)
    {
        return response()->json(
            Http::get("https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=$province")['kota_kabupaten']
        );
    }
}
