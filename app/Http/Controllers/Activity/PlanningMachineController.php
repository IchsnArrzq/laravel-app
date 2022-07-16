<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\PlanningMachine;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;

class PlanningMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PlanningMachine::with(['product', 'machine', 'shift', 'product.customer'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'machine_id' => 'required|exists:machines,id',
            'shift_id' => 'required|exists:shifts,id',
            'qty_planning' => 'required',
            'datetimein' => 'required|date',
            'datetimeout' => 'required|date',
        ]);
        try {
            PlanningMachine::create([
                'product_id' => $request->product_id,
                'machine_id' => $request->machine_id,
                'shift_id' => $request->shift_id,
                'qty_planning' => $request->qty_planning,
                'datetimein' => Carbon::parse($request->datetimein)->format('Y-m-d H:i:s'),
                'datetimeout' => Carbon::parse($request->datetimeout)->format('Y-m-d H:i:s'),
                'total' => Carbon::parse($request->datetimein)->diffInHours(Carbon::parse($request->datetimeout)),
            ]);
            return response()->json([
                'title' => 'success',
                'message' => 'success create planning machine'
            ]);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(PlanningMachine::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(PlanningMachine::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'machine_id' => 'required|exists:machines,id',
            'shift_id' => 'required|exists:shifts,id',
            'qty_planning' => 'required',
            'datetimein' => 'required|date',
            'datetimeout' => 'required|date',
        ]);
        if (Carbon::parse($request->datetimein)->gt(Carbon::parse($request->datetimeout))) {
            return throw new Error('less then');
        }
        try {
            PlanningMachine::find($id)->update([
                'product_id' => $request->product_id,
                'machine_id' => $request->machine_id,
                'shift_id' => $request->shift_id,
                'qty_planning' => $request->qty_planning,
                'datetimein' => Carbon::parse($request->datetimein)->format('Y-m-d H:i:s'),
                'datetimeout' => Carbon::parse($request->datetimeout)->format('Y-m-d H:i:s'),
                'total' => Carbon::parse($request->datetimein)->diffInHours(Carbon::parse($request->datetimeout)),
            ]);
            return response()->json([
                'title' => 'success',
                'message' => 'success create planning machine'
            ]);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(PlanningMachine::find($id)->delete());
    }
}
