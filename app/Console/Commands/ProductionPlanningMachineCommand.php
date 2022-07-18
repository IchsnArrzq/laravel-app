<?php

namespace App\Console\Commands;

use App\Models\PlanningMachine;
use App\Models\Production;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProductionPlanningMachineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:productionplanningmachine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update if we have null planning machine';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('running command');
        foreach (PlanningMachine::whereDate('datetimein', today())->orWhereDate('datetimeout', Carbon::tomorrow())->get() as $planning_machine) {
            Production::whereNull('planning_machine_id')->where('machine_id', $planning_machine->machine_id)->whereBetween('created_at', [$planning_machine->datetimein, $planning_machine->datetimeout])->update([
                'planning_machine_id' => $planning_machine->id
            ]);
        }
        $this->info('success runnning');
    }
}
