<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Machine;
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
            'machine' => 'required'
        ]);
        $fields = [];
        $targets = [];
        $actuals = [];
        $percentages = [];
        foreach (Machine::find($request->machine)->planning_machines_monitor as $planning_machine) {
            if (Carbon::parse($planning_machine->in)->gt($planning_machine->out)) {
                for ($i = Carbon::parse($planning_machine->date . ' ' . $planning_machine->in); $i <= Carbon::parse(Carbon::parse($planning_machine->date)->tomorrow()->format('Y-m-d') . ' ' . $planning_machine->out); $i->addHour()) {
                    $targets[$i->format('H:i')] = $planning_machine->qty_planning;
                    $actuals[$i->format('H:i')] = 50;
                    $percentages[$i->format('H:i')] = (50 / $planning_machine->qty_planning * 100).'%';
                }
            } else {
                for ($i = Carbon::parse($planning_machine->in); $i <= Carbon::parse($planning_machine->out); $i->addHour()) {
                    $targets[$i->format('H:i')] = $planning_machine->qty_planning;
                    $actuals[$i->format('H:i')] = 50;
                    $percentages[$i->format('H:i')] = (50 / $planning_machine->qty_planning * 100).'%';
                }
            }
        }
        return response()->json([
            'fields' => $fields,
            'targets' => $targets,
            'actuals' => $actuals,
            'percentages' => $percentages,
        ]);
    }
}
