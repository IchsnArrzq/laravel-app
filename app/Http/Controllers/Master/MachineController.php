<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Machine;
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
        return response()->json(Machine::with(['planning_machines','planning_machines.product','planning_machines.productions','planning_machine','planning_machine.product','planning_machine.productions'])->get());
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
            'number' => 'required|unique:machines'
        ]);
        try{
            Machine::create($record);
            return response()->json([
                'title' => 'success',
                'message' => 'success create machine'
            ]);
        }catch(Exception $exception){
            return response()->json($exception->getMessage(),500);
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
        $record = $request->validate([
            'name' => 'required',
            'number' => 'required'
        ]);
        try{
            $machine = Machine::find($id)->update($record);
            return response()->json([
                'title' => 'success',
                'message' => 'success update machine'
            ]);
        }catch(Exception $exception){
            return response()->json($exception->getMessage(),500);
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
