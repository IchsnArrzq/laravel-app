<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\PlanningMachine;
use App\Models\Production;
use Carbon\Carbon;
use Exception;
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
        $times = [];
        $fields = [];
        $targets = [];
        $actuals = [];
        $percentages = [];
        $line_stop_a = null;
        $line_stop_b = null;
        $line_stop_c = null;
        $line_stop_other = null;
        foreach (Machine::find($request->machine)->planning_machines_monitor as $planning_machine) {
            for ($i = Carbon::parse($planning_machine->datetimein); $i->lte(Carbon::parse($planning_machine->datetimeout)); $i->addHour()) {
                if ($i->gt(today()) or $i->lte(Carbon::tomorrow())) {
                    if ($i->gt(today()->setHour($request->hour))) {
                        $hour = $i;
                        $qty_actual = $planning_machine->productions()->whereDate('created_at', $hour->format('Y-m-d'))->whereTime('created_at', '>=', $hour->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', $hour->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc')->first()?->qty_actual;
                        $hour->startOfHour();
                        $times[$i->format('H:i')] = $i->format('Y-m-d H:i:s');
                        $targets[$i->format('H:i')] = $planning_machine->qty_planning;
                        $actuals[$i->format('H:i')] = $i->lte(now()) ? $qty_actual : '0';
                        $percentages[$i->format('H:i')] = $i->lte(now()) ? ($qty_actual / $planning_machine->qty_planning * 100) . '%' : '0%';
                    }
                }
            }
            $line_stop_a = Production::whereDate('created_at', now()->format('Y-m-d'))->whereTime('created_at', '>=', now()->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', now()->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc')->first()?->line_stop_a;
            $line_stop_b = Production::whereDate('created_at', now()->format('Y-m-d'))->whereTime('created_at', '>=', now()->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', now()->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc')->first()?->line_stop_b;
            $line_stop_c = Production::whereDate('created_at', now()->format('Y-m-d'))->whereTime('created_at', '>=', now()->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', now()->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc')->first()?->line_stop_c;
            $line_stop_other = Production::whereDate('created_at', now()->format('Y-m-d'))->whereTime('created_at', '>=', now()->startOfHour()->format('H:i:s'))->whereTime('created_at', '<=', now()->endOfHour()->format('H:i:s'))->orderBy('created_at', 'desc')->first()?->line_stop_other;
        }
        return response()->json([
            'times' => $times,
            'fields' => $fields,
            'targets' => $targets,
            'actuals' => $actuals,
            'percentages' => $percentages,
            'line_stop_a' => $line_stop_a,
            'line_stop_b' => $line_stop_b,
            'line_stop_c' => $line_stop_c,
            'line_stop_other' => $line_stop_other,
        ]);
    }
}
