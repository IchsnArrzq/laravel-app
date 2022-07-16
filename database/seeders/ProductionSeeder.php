<?php

namespace Database\Seeders;

use App\Models\PlanningMachine;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 2) as $key => $minute) {
            Production::create([
                'planning_machine_id' => collect(PlanningMachine::pluck('id'))->random(),
                'line_stop_a' => rand(1, 10),
                'line_stop_b' => rand(1, 10),
                'line_stop_c' => rand(1, 10),
                'line_stop_other' => rand(1, 10),
                'qty_actual' => rand(1, 1000),
                'datetime' => now()->subMinute((int)$key . '0'),
                'status' => 1,
                'created_at' => now()->subMinute((int)$key . '0'),
                'updated_at' => now()->subMinute((int)$key . '0'),
            ]);
        }
    }
}
