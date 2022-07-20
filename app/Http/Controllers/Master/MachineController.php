<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->page) {
            return response()->json(Machine::with(['planning_machines', 'planning_machines.product', 'planning_machines.productions', 'planning_machines_monitor', 'planning_machines_monitor.product', 'planning_machines_monitor.productions', 'planning_machines_monitor.shift', 'production_status_monitor'])->paginate(10));
        }
        return response()->json(Machine::with(['planning_machines', 'planning_machines.product', 'planning_machines.productions', 'planning_machines_monitor', 'planning_machines_monitor.product', 'planning_machines_monitor.productions', 'planning_machines_monitor.shift', 'production_status_monitor'])->get());
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
        $record = $request->validate([
            'name' => 'required',
            'number' => 'required|unique:machines',
            'category_machine_id' => 'required|exists:category_machines,id',
            'code' => 'required',
            'brand' => 'required',
            'purchase_date' => 'required',
            'manufacture_date' => 'required',
            'stroke' => 'required',
            'production_area' => 'required',
        ]);
        try {
            Machine::create($record);
            return response()->json([
                'title' => 'success',
                'message' => 'success create machine'
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
        return response()->json(Machine::with(['planning_machines'])->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Machine::find($id));
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
            'name' => 'required',
            'number' => 'required',
            'category_machine_id' => 'required|exists:category_machines,id',
            'code' => 'required',
            'brand' => 'required',
            'purchase_date' => 'required',
            'manufacture_date' => 'required',
            'stroke' => 'required',
            'production_area' => 'required',
        ]);
        try {
            Machine::find($id)->update([
                'name' => $request->name,
                'number' => $request->number,
                'category_machine_id' => $request->category_machine_id,
                'code' => $request->code,
                'brand' => $request->brand,
                'purchase_date' => Carbon::parse($request->purchase_date)->addDay(1)->format('Y-m-d'),
                'manufacture_date' => Carbon::parse($request->manufacture_date)->addDay(1)->format('Y-m-d'),
                'stroke' => $request->stroke,
                'production_area' => $request->production_area,
            ]);
            return response()->json([
                'title' => 'success',
                'message' => 'success update machine'
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
        return response()->json(Machine::find($id)->delete());
    }
}
