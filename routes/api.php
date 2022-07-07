<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    //activity
    Route::resource('planning', \App\Http\Controllers\Activity\PlanningMachineController::class);
    Route::post('monitor', \App\Http\Controllers\Activity\MachineMonitorController::class);

    //master
    Route::resource('customer', \App\Http\Controllers\Master\CustomerController::class);
    Route::resource('product', \App\Http\Controllers\Master\ProductController::class);
    Route::resource('role', \App\Http\Controllers\Master\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\Master\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\Master\UserController::class);
    Route::resource('machine', \App\Http\Controllers\Master\MachineController::class);
    Route::resource('shift', \App\Http\Controllers\Master\ShiftController::class);
    //region
    Route::get('provinces', [\App\Http\Controllers\RegionController::class, 'provinces']);
    Route::get('city/{province}', [\App\Http\Controllers\RegionController::class, 'city']);

    //
    Route::post('times', function () {
        request()->validate([
            'hour' => 'required',
            'minute' => 'required',
            'second' => 'required',
        ]);
        $hours = [];
        foreach (range(1, 24) as $key => $jam) {
            $hours[$key] = Carbon\Carbon::now()->setHour(request()->hour)->setMinute(request()->minute)->setSecond(request()->second)->addHour($key)->format('H:i');
        }
        return response()->json($hours);
    });
});
