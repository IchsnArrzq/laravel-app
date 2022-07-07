<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\PlanningMachine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MachineMonitorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'hour' => 'required',
            'minute' => 'required',
            'second' => 'required',
            'planning_machine_id' => 'required'
        ]);
        $planning_machine = PlanningMachine::find($request->planning_machine_id);
        // $machine = PlanningMachine->machine;

        $fields = [];
        $targets = [];
        $actuals = [];
        $percentages = [];

        foreach (range(1, 24) as $key => $jam) {
            $fields[$key] = Carbon::now()->setHour(request()->hour)->setMinute(request()->minute)->setSecond(request()->second)->addHour($key)->format('H:i');
        }
        foreach ($fields as $key => $field) {
            // compare date
            // echo (Carbon::parse($field)->gt($planning_machine->in) and Carbon::parse($field)->lt($planning_machine->out)).' = '.$planning_machine->in.' =  '.$field;
            if(Carbon::parse($field)->gt($planning_machine->in) and Carbon::parse($field)->lt($planning_machine->out)){
                $targets[$key] = $planning_machine->qty_planning;
            }
            if(Carbon::parse($field)->format('H:i:s') == Carbon::parse($planning_machine->in)->format('H:i:s')){
                $targets[$key] = $planning_machine->qty_planning;
            }
            if(Carbon::parse($field)->format('H:i:s') == Carbon::parse($planning_machine->out)->format('H:i:s')){
                $targets[$key] = $planning_machine->qty_planning;
            }
        }

        return response()->json([
            'fields' => $fields,
            'targets' => $targets
        ]);

    }
}
